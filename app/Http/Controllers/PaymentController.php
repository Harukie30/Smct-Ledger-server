<?php

namespace App\Http\Controllers;

use App\Jobs\ImportPayments;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PaymentController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('per_page', 10);

        $payments = Payment::with(
                        [
                            'location'      => fn($q) =>  $q->select(['id','location_name']),
                            'installment'   => fn($n) =>  $n->select(['id','customer_name','so_number']),
                            'voidedBy'      => fn($n) =>  $n->select(['id','name']),
                            'editedBy'      => fn($n) =>  $n->select(['id','name']),
                        ]
                    )
                    ->search($search)
                    ->paginate(
                        $page,
                        [
                            'id',
                            'location_id',
                            'installment_id',
                            'payment_date',
                            'document_number',
                            'or_number',
                            'amount',
                            'memo_description',
                            'invoice_number',
                            'generic_collector',
                            'isrebatable',
                            'voided_by',
                            'edited_by',
                            'is_void',
                            'reasonToVoid',
                            'remarks'
                        ]
                    );

        return response()->json(
            [
                'payments'  =>  $payments
            ]
            ,200
        );
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
                'rows'                      => ['required', 'array'],
                'rows.*.document_number'    => ['required'],
                'rows.*.or_number'          => ['required'],
            ],
            [
                'rows.*.document_number.required'       =>  'Document number is required for each accounts.PLease check the uploaded file',
                'rows.*.or_number.required'             =>  'OR number is required for each accounts.PLease check the uploaded file',
            ]
        );

        $file_name = $request->file_name;

        $chunks = array_chunk($request->rows, 500);

        foreach ($chunks as $index => $chunk)
        {
            $batchNumber = $index + 1;

            $startRow = ($index * 500) + 1;
            $endRow = $startRow + count($chunk) - 1;

            $batch = "{$batchNumber} [{$startRow}-{$endRow}]";

            ImportPayments::dispatch(
                $batch,
                $chunk,
                Auth::user(),
                $file_name
            );
        }

        return response()->json(
            [
                'message' => 'Payment import is in progress. Please check the logs to monitor the upload status.'
            ]
            ,200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return response()->json(
            [
                'payment'   => $payment->load(
                                    [
                                        'location:id,location_name',
                                        'installment:id,customer_name,so_number',
                                        'voided_by:id,name',
                                        'edited_by:id,name',
                                    ]
                                )
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate(
            [
                'locationId'            =>  ['required', Rule::exists('locations','id')],
                'installmentId'         =>  ['required', Rule::exists('installments','id')],
                'payment_date'          =>  ['required', 'date'],
                'document_number'       =>  ['required', Rule::unique('payments','document_number')->ignore($payment->id)],
                'or_number'             =>  ['required'],
                'amount'                =>  ['required', 'numeric'],
                'isrebatable'           =>  ['required', 'boolean'],
                'memo_description'      =>  ['nullable'],
                'invoice_number'        =>  ['nullable'],
                'generic_collector'     =>  ['nullable'],
                'remarks'               =>  ['required']
            ]
        );

        $payment->update(
            [
                'location_id'           =>  $validated['locationId'],
                'installment_id'        =>  $validated['installmentId'],
                'payment_date'          =>  $validated['payment_date'],
                'document_number'       =>  $validated['document_number'],
                'or_number'             =>  $validated['or_number'],
                'amount'                =>  $validated['amount'],
                'isrebatable'           =>  $validated['isrebatable'],
                'memo_description'      =>  $validated['memo_description'] ?: $payment->memo_description,
                'invoice_number'        =>  $validated['invoice_number'] ?: $payment->invoice_number,
                'generic_collector'     =>  $validated['generic_collector']  ?: $payment->generic_collector,
                'remarks'               =>  $validated['remarks']
            ]
        );

        return response()->json(
            [
                'message'   =>  'Payment updated successfully'
            ]
            ,201
        );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function toVoid(Payment $payment , Request $request)
    {
        $validated = $request->validate(
            [
                'reason'    =>  ['required']
            ]
        );

        $payment->update(
            [
                'voided_by'     =>  Auth::id(),
                'is_void'       =>  true,
                'reasonToVoid'  =>  $validated['reason']
            ]
        );

        return response()->json(
            [
                'message'   =>  'Payment voided successfully'
            ]
            ,201
        );
    }
}
