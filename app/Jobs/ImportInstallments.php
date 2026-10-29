<?php

namespace App\Jobs;

use App\Events\LogEvent;
use App\Models\Installment;
use App\Models\InstallmentLedger;
use App\Models\Location;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Throwable;

class ImportInstallments implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct
    (
        public string $batch,
        public array $data,
        public User $user,
        public string $file_name
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $missingRows = [];
        $installments = [];

        $requiredFields = [
            'internal_id',
            'customer_name',
            'date_of_purchase',
            'first_due_date',
            'term',
            'monthly_installment',
            'monthly_principal',
            'monthly_interest',
            'rebate_amount',
            'item',
            'total_accounts_receivable',
            'down_payment',
            'financed_amount',
            'location',
            'item_class'
        ];

        foreach ($this->data as $item) {
            $dataMissing = [];

            foreach ($requiredFields as $field) {
                if (!isset($item[$field])) {
                    $dataMissing[] = $field;
                }
            }

            if (!empty($dataMissing)) {
                $fields = implode(', ', $dataMissing);

                $missingRows[] = "Unable to generate an installment for {$item['sales_order_no']} due to missing required fields: {$fields}.";
            } else {

                $location = Location::firstOrCreate(
                    [
                        'location_name'     =>  $item['location']
                    ],
                    [
                        'location_name'     =>  $item['location']
                    ]
                );

                $soNumber = str_replace('Sales Order #','', $item['sales_order_no']);
                $isLedgerExist = Installment::where(
                                    fn($q)
                                    =>
                                    $q->where('so_number', $soNumber)
                                    ->where('customer_name', $item['customer_name'])
                                )->exists();

                if(!$isLedgerExist){
                    $installments[] = [
                        'location_id'                   =>  $location->id,
                        'internal_id'                   =>  $item['internal_id'],
                        'customer_name'                 =>  $item['customer_name'],
                        'so_number'                     =>  str_replace('Sales Order #','', $item['sales_order_no']),
                        'purchase_date'                 =>  $item['date_of_purchase'],
                        'first_due_date'                =>  $item['first_due_date'],
                        'term'                          =>  $item['term'],
                        'monthly_installment'           =>  $item['monthly_installment'],
                        'monthly_principal'             =>  $item['monthly_principal'],
                        'monthly_interest'              =>  $item['monthly_interest'],
                        'item'                          =>  $item['item'],
                        'rebate_amount'                 =>  $item["rebate_amount"],
                        'item_class'                    =>  $item["item_class"],
                        'total_accounts_receivable'     =>  $item['total_accounts_receivable'],
                        'downpayment'                   =>  $item['down_payment'],
                        'financed_amount'               =>  $item['financed_amount'],
                        'created_at'                    =>  now(),
                        'updated_at'                    =>  now(),
                    ];
                }
            }
        }

        if(!empty($installments)){

            DB::transaction(
                function () use ($installments)
                {
                    Installment::insert($installments);

                    $ledgerData = [];
                    $so_numbers = array_column($installments, 'so_number');
                    $savedInstallments = Installment::whereIn('so_number', $so_numbers)->get(['id', 'term', 'first_due_date']);

                    foreach($savedInstallments as $savedInstallment)
                    {
                        for($i = 1; $i <= $savedInstallment->term; $i++)
                        {
                            $ledgerData[] = [
                                'installment_id'                => $savedInstallment->id,
                                'installment_number'            => $i,
                                'due_date'                      => Carbon::parse($savedInstallment->first_due_date)
                                                                    ->addMonths($i - 1)
                                                                    ->toDateString(),
                                'created_at'                    => now(),
                                'updated_at'                    => now(),
                            ];
                        }
                    }

                    foreach (array_chunk($ledgerData, 500) as $ledgerChunk)
                    {
                        InstallmentLedger::insert($ledgerChunk);
                    }
                }
            );
        }

        $logInfo = [];
        if(!empty($missingRows))
        {
            foreach($missingRows as $rowsItem)
            {
                $logInfo[] = [
                    'info'          => $rowsItem,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];

                event(
                    new LogEvent
                    (
                        $this->user->id,
                        $this->file_name,
                        $rowsItem,
                        now()->toISOString()
                    )
                );
            }
        }

        if(!empty($logInfo))
        {
            Log::insert($logInfo);
        }

        $info = sprintf(
                    "File uploaded: %s \nBatch: %s successfully \nUploader: %s",
                    $this->file_name,
                    $this->batch,
                    $this->user->name
                );

        Log::create(
            [
                'file_name' =>  $this->file_name,
                'info'      => $info,
            ]
        );

        event(
            new LogEvent
            (
                $this->user->id,
                $this->file_name,
                $info,
                now()->toISOString()
            )
        );
    }

    public function failed(?Throwable $exception): void
    {
        $info = sprintf(
                        "File upload failed: %s\nBatch: %s failed\nUploader: %s\nError: %s",
                        $this->file_name,
                        $this->batch,
                        $this->user->name,
                        $exception?->getMessage() ?? 'Unknown error'
                    );

        Log::create(
            [
                'file_name' => $this->file_name,
                'info'      =>  $info
            ]
        );

        event(
            new LogEvent
            (
                $this->user->id,
                $this->file_name,
                $info,
                now()->toISOString()
            )
        );
    }
}
