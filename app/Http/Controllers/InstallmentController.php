<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Jobs\ImportInstallments;
use App\Models\Installment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input("per_page",10);

        $installments = Installment::with(['location' => fn($q) => $q->select(['id','location_name'])])
                                        ->search($search)
                                        ->paginate(
                                            $page,
                                            [
                                                'id',
                                                'location_id',
                                                'internal_id',
                                                'customer_name',
                                                'purchase_date',
                                                'so_number',
                                            ]
                                        );
        return response()->json(
            [
                'accounts'      =>  $installments
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
                'rows.*.sales_order_no'     => ['required']
            ],
            [
                'rows.*.sales_order_no.required'    =>  'SO number is required for each accounts.PLease check the uploaded file'
            ]
        );

        $file_name = $request->file_name;

        $chunks = array_chunk($request->rows, 500);

        foreach ($chunks as $index => $chunk) {
            $batchNumber = $index + 1;

            $startRow = ($index * 500) + 1;
            $endRow = $startRow + count($chunk) - 1;

            $batch = "{$batchNumber} [{$startRow}-{$endRow}]";

            ImportInstallments::dispatch(
                $batch,
                $chunk,
                Auth::user(),
                $file_name
            );
        }

        return response()->json(
            [
                'message' => 'Installment import is in progress. Please check the logs to monitor the upload status.'
            ]
            ,200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Installment $installment)
    {
        return response()->json(
            [
                'installment'  => $installment->load(['location','installmentLedgers'])
            ]
        );
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
