<?php
namespace App\Jobs;

use App\Events\LogEvent;
use App\Models\Installment;
use App\Models\Location;
use App\Models\Log;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Throwable;

class ImportPayments implements ShouldQueue
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
        $payments = [];

        $requiredFields = [
            'date',
            'document_number',
            'eligible_for_rebate',
            // 'generic_collector',
            'location',
            'maximum_of_amount',
            // 'memo_main',
            // 'minimum_invoice_number_leasing',
            'minimum_sales_order_number_for_dp',
            'name',
            'or_number'
        ];

        foreach ($this->data as $item) {
            $dataMissing = [];

            foreach ($requiredFields as $field)
            {
                if (!isset($item[$field]))
                {
                    $dataMissing[] = $field;
                }
            }

            if (!empty($dataMissing))
            {
                $fields = implode(', ', $dataMissing);

                $missingRows[] = "Unable to save payment for Document number : {$item['document_number']} due to missing required fields: {$fields}.";
            }
            else
            {
                $soNumber = str_replace('Sales Order #','', $item['minimum_sales_order_number_for_dp']);
                $isInstallmentExist = Installment::where(
                                        fn($q)
                                        =>
                                        $q->where('so_number', $soNumber)
                                    )->exists();

                if(!$isInstallmentExist)
                {
                    $info = "Unable to save payment for Document No. {$item['document_number']}: No matching installment found for {$item['minimum_sales_order_number_for_dp']}.";

                    Log::create(
                        [
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
                else
                {
                    $installment = Installment::where(
                                        fn($q)
                                        =>
                                        $q->where('so_number', $soNumber)
                                    )->first();

                    $location = Location::firstOrCreate(
                        [
                            'location_name'     =>  $item['location']
                        ],
                        [
                            'location_name'     =>  $item['location']
                        ]
                    );

                    $isPaymentExist = Payment::where(
                                        fn($q)
                                        =>
                                        $q->where('document_number', $item['document_number'])
                                        ->where('or_number', $item['or_number'])
                                    )->exists();

                    if(!$isPaymentExist)
                    {
                        $payments[] = [
                            'location_id'                   =>  $location->id,
                            'installment_id'                =>  $installment->id,
                            'payment_date'                  =>  $item["date"],
                            'document_number'               =>  $item["document_number"],
                            'or_number'                     =>  $item["or_number"],
                            'amount'                        =>  $item["maximum_of_amount"],
                            'customer_name'                 =>  $item["name"],
                            'isrebatable'                   => in_array(
                                                                    strtolower(trim((string) $item['eligible_for_rebate'])),
                                                                    ['yes', '1'],
                                                                    true
                                                                ),
                            'memo_description'              =>  isset($item['memo_main']) ? $item["memo_main"] : null,
                            'invoice_number'                =>  isset($item['minimum_invoice_number_leasing']) ? trim(str_replace('Invoice #','',$item["minimum_invoice_number_leasing"])) : null,
                            'generic_collector'             =>  isset($item["generic_collector"]) ? $item["generic_collector"] : null,
                            'created_at'                    =>  now(),
                            'updated_at'                    =>  now(),
                        ];
                    }
                }
            }
        }

        if(!empty($payments))
        {
            DB::transaction(
                function () use ($payments)
                {
                    Payment::insert($payments);
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
                'info'      =>  $info,
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
