<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Installment;
use App\Models\InstallmentLedger;
use App\Models\Location;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Illuminate\Support\months;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'rows'  => ['required', 'array']
            ],
            [
                'rows.*.sales_order_no.required'    =>  'SO number is required for each accounts.PLease check the uploaded file'
            ]
        );

        $data = $request->rows;
        $missingRows = [];
        $installments = [];

            // 'is_rebated',

        $requiredFields = [
            'internal_id',
            'customer_name',
            'date_of_purchase',
            'first_due_date',
            'term',
            'monthly_installment',
            'monthly_principal',
            'monthly_interest',
            'item',
            'total_accounts_receivable',
            'down_payment',
            'financed_amount',
            'location'
        ];

        foreach ($data as $item) {
            $dataMissing = [];

            foreach ($requiredFields as $field) {
                if (empty($item[$field])) {
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

                $is_rebated = false;
                // if($item['is_rebated'] == 'no')
                // {
                //     $is_rebated = false;
                // }
                // if($item['is_rebated'] == 'yes')
                // {
                //     $is_rebated = true;
                // }

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
                        'is_rebated'                    =>  $is_rebated,
                        'item'                          =>  $item['item'],
                        'total_accounts_receivable'     =>  $item['total_accounts_receivable'],
                        'downpayment'                   =>  $item['down_payment'],
                        'financed_amount'               =>  $item['financed_amount'],
                        'created_at'                    => now(),
                        'updated_at'                    => now(),
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

                    if(!empty($ledgerData))
                    {
                        InstallmentLedger::insert($ledgerData);
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
                    'info'  =>  $rowsItem,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }
        }

        if(!empty($logInfo))
        {
            Log::insert($logInfo);
        }

        Log::create(
            [
                'info'  =>  Auth::user()->name . ' uploaded an installment file for processing.'
            ]
        );

        return response()->json(
            [
                'message' => 'Installment generation completed successfully.'
            ]
            , 200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Installment $installment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Installment $installment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Installment $installment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Installment $installment)
    {
        //
    }
}
