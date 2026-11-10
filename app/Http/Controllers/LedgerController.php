<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Installment;
use App\Models\InstallmentLedger;
use App\Models\Payment;
use App\Services\LedgerCalculator;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;



class LedgerController extends Controller
{
    /**
     * Ipakita ang ledger sa usa ka loan.
     * GET /api/ledger/{installment}   ({installment} = installments.id)
     *
     * Walay gi-save nga balance/penalty: i-compute sa LedgerCalculator kada view.
     * Ang response nagsunod sa gi-basa sa frontend (readAccount): { installment: {...} }
     */
    public function show(Installment $installment, LedgerCalculator $calculator): JsonResponse
    {
        // 1) Ang schedule sa maong loan ra (installment_id), sorted first hangtod last.
        $schedule = InstallmentLedger::where('installment_id', $installment->id)
            ->orderBy('installment_number')
            ->get();

        // 2) Ang payments sa maong loan ra, sorted by payment_date dayon id
        //    (importante ang order kay ang calculator mo-apply sumala sa order).
        //    Kung naay void feature, i-filter diri ang voided payments (wala pa sa payments migration).
        $payments = Payment::where('installment_id', $installment->id)
            ->orderBy('payment_date')
            ->orderBy('id')
            ->get();

        // 3) I-compute
        $ledger = $calculator->compute($installment, $schedule, $payments);

        // 4) Ang mga row sa Loan Ledger, gi-map sa mga ngalan nga gi-basa sa frontend
        $lines = array_map(function (array $row) {
            $paid = $row['payments'];   // mga payment nga na-apply niining installment
            return [
                'installment_number'       => $row['installment_no'],
                'due_date'                 => $row['due_date'],
                'payment_date'             => $paid ? end($paid)['date'] : null,   // pinakaulahing payment
                'payment_ref'              => implode(', ', array_filter(array_column($paid, 'or_no'))),
                'penalty'                  => $row['penalty'],
                'rebate'                   => $row['rebate'],
                'monthly_installment_paid' => $row['paid'],
                'monthly_principal_paid'   => $row['principal_paid'],
                'monthly_interest_paid'    => $row['interest_paid'],
                'penalty_paid'             => $row['penalty_paid'],
                'overdue'                  => $row['overdue'],
                'balance_wo_penalty'       => $row['balance_no_pen'],
                'balance_w_penalty'        => $row['balance_w_pen'],
            ];
        }, $ledger['installments']);

        // 5) Ang Payment History: ang payments gikan sa database + ang resulta sa calculator kada payment
        $calc = collect($ledger['payments'])->keyBy('id');
        $paymentRows = $payments->map(function ($p) use ($calc) {
            $c = $calc->get($p->id, []);
            return [
                'id'                     => $p->id,
                'payment_date'           => Carbon::parse($p->payment_date)->toDateString(),
                'or_number'              => $p->or_number,
                'amount'                 => $p->amount,
                'penalty_paid'           => $c['penalty_paid'] ?? 0,
                'applied_to_monthly_due' => $c['applied_to_monthly_due'] ?? 0,
                'unapplied_excess'       => $c['unapplied_excess'] ?? 0,
                'received_by'            => $p->generic_collector,
                'remarks'                => $p->memo_description,
                'status'                 => $c['status'] ?? '',
                'isrebatable'            => (bool) $p->isrebatable,
            ];
        })->values();

        // 6) Ang location (kung naay relation sa Installment model)
        if (method_exists($installment, 'location')) {
            $installment->loadMissing('location');
        }

        return response()->json([
            'installment' => array_merge($installment->toArray(), [
                'loan_status'        => $ledger['status'],
                'current_balance'    => $ledger['current_balance'],
                'total_balance_due'  => $ledger['total_balance_due'],
                'total_amount_due'   => $ledger['total_amount_due'],
                'total_payments'     => $ledger['total_payments'],
                'total_penalty'      => $ledger['total_penalty'],
                'unrecovered_cost'   => $ledger['unrecovered_cost'],
                'installment_ledgers' => $lines,
                'payments'           => $paymentRows,
            ]),
        ]);
    }
}
