<?php

namespace App\Services;

use Carbon\Carbon;                         // para sa mga petsa
use Illuminate\Support\Collection;         // para sa listahan sa payments

/**
 * LedgerCalculator
 * ----------------
 * Gi-compute ang loan ledger gikan sa loan + payments.
 * Walay gi-save nga balance/penalty: i-recompute kada view sa ledger.
 * Basehan: "Ledger Corrected" workbook (Loan Ledger, Payment History, Allocation Engine).
 *
 * Order sa pag-apply sa matag payment:
 *   penalty -> interest -> principal, sugod sa pinakaunang installment nga wala pa bayri.
 */
class LedgerCalculator
{
    /**
     * Mao ni ang main function.
     *
     * @param object     $installment      Installment model (installments table): id, downpayment,
     *                              total_accounts_receivable, financed_amount, monthly_principal, monthly_interest, rebate_amount
     * @param Collection $schedule  installment_ledgers rows sa maong loan (first to last):
     *                              installment_id, installment_number, due_date
     * @param Collection $payments  payments table: id, payment_date, or_number, amount, isrebatable
     *                              (sorted by payment_date, dayon id)
     * @param Carbon|null $today    petsa karon (i-pass kung mag-test; default karon nga adlaw)
     */
    public function compute(object $installment, Collection $schedule, Collection $payments, ?Carbon $today = null): array
    {
        // Check: kinahanglan naay schedule, ug ang tanang row iya ra niining loan (installment_id)
        if ($schedule->isEmpty()) {
            throw new \InvalidArgumentException('Walay installment schedule alang niining loan.');
        }
        if ($schedule->contains(fn ($s) => (int) $s->installment_id !== (int) $installment->id)) {
            throw new \InvalidArgumentException('Naay schedule row nga dili kauban niining loan.');
        }

        // Petsa karon, gi-reset ang oras sa 00:00 para petsa ra ang itandi
        $today  = ($today ?? now())->copy()->startOfDay();
        // Penalty Rate (4% kada bulan nga late)
        $penaltyRate = 0.04;
        // Monthly Principal sa loan
        $mPrin  = (float) $installment->monthly_principal;
        // Monthly Interest sa loan
        $mInt   = (float) $installment->monthly_interest;
        // Monthly Installment = Monthly Principal + Monthly Interest
        $due    = $mPrin + $mInt;
        // Rebate Amount (kung walay rebate sa loan, 0)
        $rebateAmt = (float) ($installment->rebate_amount ?? 0);

        // ============================================================
        // STEP 1: Himoon ang "state" sa matag installment (sugod tanan 0)
        //         Ang installments ug due dates gikan sa gi-save nga schedule sa database
        // ============================================================
        $inst = [];                                             // listahan sa tanang installments
        foreach ($schedule->sortBy('installment_number') as $s) {   // first hangtod last installment
            $n = (int) $s->installment_number;
            $inst[$n] = [
                // Due Date = gikan sa schedule sa database
                'due_date'    => Carbon::parse($s->due_date)->startOfDay(),
                'paid'        => 0.0,   // Monthly Applied (principal + interest) nga nabayran na
                'int_paid'    => 0.0,   // interest nga nabayran na
                'prin_paid'   => 0.0,   // principal nga nabayran na
                'pen_accrued' => 0.0,   // penalty nga na-accrue na gikan sa mga payments
                'pen_paid'    => 0.0,   // penalty nga nabayran na
                'rebate'      => 0.0,   // rebate nga na-apply na
                'months_late' => 0,     // bulan nga late nga na-penalty na (para dili doble ang penalty)
                'payments'    => [],    // listahan sa payments (para sa Payment Breakdown)
            ];
        }

        $paymentRows = [];   // resulta kada payment (para sa Payment History)

        // ============================================================
        // STEP 2: I-apply ang matag payment, pagsunod sa petsa
        // ============================================================
        foreach ($payments as $p) {
            $paidAt = Carbon::parse($p->payment_date)->startOfDay();   // petsa sa payment
            $amount = (float) $p->amount;                         // cash nga gibayad

            // REBATE: kung eligible, ang rebate amount isip credit (dili cash)
            $rebateLeft = $p->isrebatable ? $rebateAmt : 0.0;
            // Cash nga nahibilin: mao ra kini ang makabayad sa penalty (dili mabayran sa rebate)
            $cashLeft   = $amount;

            // REBATE RULE: ma-credit lang kung mabayran ug tibuok ang tanang due hangtod sa current due
            // (monthly + penalty, cash + rebate). Kung kulang, walay rebate niining payment.
            $rebTarget = 0;   // installment no. nga makakuha sa rebate (current due)
            if ($rebateLeft > 0) {
                $rebTarget = $this->rebateTarget($inst, $paidAt);
                $pending   = 0.0;   // total nga kinahanglan bayran hangtod sa current due
                foreach ($inst as $k => $x) {
                    if ($k > $rebTarget) break;
                    $u  = max(0.0, $due - $x['paid']);
                    $monthsLateAtPayment  = max(0, $this->monthsBetween($x['due_date'], $paidAt));
                    $np = $this->penalty($u, $penaltyRate) * max(0, $monthsLateAtPayment - $x['months_late']);
                    $pending += $u + max(0.0, $x['pen_accrued'] - $x['pen_paid'] + $np);
                }
                if ($amount + $rebateLeft < $pending) $rebateLeft = 0.0;   // kulang -> walay rebate
            }

            // Resulta niining payment (mapuno sa ubos)
            $row = [
                'id'              => $p->id ?? null,
                'penalty_paid'    => 0.0,   // total penalty nga nabayran niining payment
                'monthly_applied' => 0.0,   // total monthly nga nabayran niining payment
                'rebate_applied'  => 0.0,   // total rebate nga na-apply niining payment
            ];

            $lastNo = null;   // installment nga katapusang nakagamit sa kuwarta niining payment (para sa tooltip)

            // Sugod sa pinakaunang installment (1, 2, 3 ...)
            foreach ($inst as $n => &$i) {
                // Rebate sa current due ra: kung milapas na ang current due, wala nay rebate
                if ($n > $rebTarget) $rebateLeft = 0.0;
                // Kung nahurot na ang kuwarta (cash + rebate), hunong
                if ($cashLeft + $rebateLeft <= 0) break;

                // Unpaid = Monthly Installment - nabayran na (kung bayad na, 0 -> molukso ra)
                $unpaid = max(0.0, $due - $i['paid']);
                // Months Late = bulan gikan due date hangtod petsa sa payment (dili mubu sa 0)
                $monthsLateAtPayment   = max(0, $this->monthsBetween($i['due_date'], $paidAt));
                // New Penalty = 4% sa unpaid (round up) x dugang nga bulan nga late
                $newPen = $this->penalty($unpaid, $penaltyRate) * max(0, $monthsLateAtPayment - $i['months_late']);
                // Dugang nga bulan nga na-penalty karon (detalye ra para sa Payment Breakdown tooltip)
                $newMonths = max(0, $monthsLateAtPayment - $i['months_late']);

                // PENALTY UNA: cash ra ang ipabayad, dili ang rebate
                $penDue   = max(0.0, $i['pen_accrued'] - $i['pen_paid'] + $newPen);
                $penApply = min($cashLeft, $penDue);
                // REBATE: sa current due ra (human mabayran ang penalty, nga cash ra ang gigamit)
                $rebAvail = ($n === $rebTarget) ? $rebateLeft : 0.0;
                // DAYON MONTHLY DUE: ang sobra nga cash human sa penalty + rebate, dili molapas sa unpaid
                // (interest una, dayon principal; ang rebate apil sa interest-first nga pag-apply)
                $monApply = min($unpaid, max(0.0, $cashLeft - $penApply) + $rebAvail);
                // Total nga na-apply niining installment
                $total    = $penApply + $monApply;

                // Kung wala gyud na-apply ug walay bag-ong penalty, laktaw
                if ($total <= 0 && $newPen <= 0) continue;

                // Sa monthly: INTEREST UNA. Kuhaa ang interest nga wala pa bayri
                $intApply  = min($monApply, max(0.0, $mInt - $i['int_paid']));
                // DAYON PRINCIPAL: ang nahibilin sa monthly
                $prinApply = $monApply - $intApply;

                // REBATE: sa monthly due ra (dili sa penalty), dili molapas sa monthly applied
                $rebApply = ($rebAvail > 0 && $monApply > 0) ? min($rebAvail, $monApply) : 0.0;
                // Cash nga gigamit niining installment = penalty + monthly nga dili rebate
                $cashUsed = $penApply + ($monApply - $rebApply);

                // I-update ang state sa installment
                $i['pen_accrued'] += $newPen;      // idugang ang bag-ong penalty
                $i['pen_paid']    += $penApply;    // idugang ang penalty nga nabayran
                $i['paid']        += $monApply;    // idugang ang monthly nga nabayran
                $i['int_paid']    += $intApply;    // idugang ang interest nga nabayran
                $i['prin_paid']   += $prinApply;   // idugang ang principal nga nabayran
                $i['rebate']      += $rebApply;    // idugang ang rebate
                $i['months_late']    = $monthsLateAtPayment;        // hinumdomi ang bulan nga late

                // I-record sa Payment Breakdown (kung naay na-apply)
                if ($total > 0) {
                    $i['payments'][] = [
                        'date'      => $paidAt->toDateString(),   // petsa sa payment
                        'or_no'     => $p->or_number ?? null,         // OR / Ref No.
                        'applied'   => round($total, 2),          // Applied
                        'principal' => round($prinApply, 2),      // Principal
                        'interest'  => round($intApply, 2),       // Interest
                        'penalty'   => round($penApply, 2),       // Penalty
                        'rebate'    => round($rebApply, 2),       // Rebate
                        // Detalye sa kuwenta (para sa tooltip; dili makaapekto sa resulta)
                        'unpaid_before'     => round($unpaid, 2),                              // unpaid sa dili pa mabayran
                        'months_late'       => $monthsLateAtPayment,                           // bulan nga late hangtod sa petsa sa payment
                        'new_months'        => $newMonths,                                     // bulan nga bag-ong gi-penalty
                        'penalty_per_month' => $this->penalty($unpaid, $penaltyRate),          // 4% sa unpaid, round up
                        'new_penalty'       => round($newPen, 2),                              // bag-ong penalty niining payment
                        'unpaid_after'      => round($unpaid - $monApply, 2),                  // unpaid human sa payment
                        'payment_amount'    => round($amount, 2),                              // tibuok nga cash nga gibayad
                        'cash_available'    => round($cashLeft, 2),                            // cash nga i-apply niining installment
                        'carried_from'      => $lastNo,                                        // installment diin gikan ang sobra (null = bag-ong payment)
                        'cash_after'        => round($cashLeft - $cashUsed, 2),                // sobra nga moadto sa sunod nga installment
                    ];
                    $lastNo = $n;
                }

                // I-ihap sa total niining payment
                $row['penalty_paid']    += $penApply;
                $row['monthly_applied'] += $monApply;
                $row['rebate_applied']  += $rebApply;
                // Ibawas ang cash nga gigamit; ang sobra nga cash moadto sa sunod nga installment
                $cashLeft -= $cashUsed;
                // Human ang current due, walay sobra nga rebate nga moadto sa sunod
                if ($n === $rebTarget) $rebateLeft = 0.0;
            }
            unset($i);   // tangtanga ang reference sa loop

            // ---- Mga column sa Payment History ----
            // Applied to Monthly Due = monthly applied - rebate (cash portion lang)
            $applied = max(0.0, $row['monthly_applied'] - $row['rebate_applied']);
            // Unapplied Excess = Amount Paid - Penalty Paid - Applied to Monthly Due
            $excess  = max(0.0, $amount - $row['penalty_paid'] - $applied);

            $paymentRows[] = [
                'id'                     => $row['id'],
                'penalty_paid'           => round($row['penalty_paid'], 2),
                'applied_to_monthly_due' => round($applied, 2),
                'unapplied_excess'       => round($excess, 2),
                // Validation / Status
                'status' => $amount <= 0 ? 'Check amount'
                    : ($excess > 0 ? 'Recorded with excess'
                    : ($row['penalty_paid'] > 0 ? 'Applied to penalty first' : 'Recorded')),
            ];
        }

        // ============================================================
        // STEP 3: Himoon ang mga row sa Loan Ledger ug ang totals
        // ============================================================
        // Loan Amount - Downpayment (sugod sa running balance)
        $base       = (float) $installment->total_accounts_receivable - (float) $installment->downpayment;
        $cumPaid    = 0.0;   // running total sa Monthly Installment Paid
        $cumPen     = 0.0;   // running total sa Penalty
        $cumPenPaid = 0.0;   // running total sa Penalty Paid
        $totalPrinPaid = 0.0;   // total Principal Paid (para sa Unrecovered Cost)
        $amountDue  = 0.0;   // Total Amount Due
        $rows       = [];    // mga row sa ledger

        foreach ($inst as $n => $i) {
            // Unpaid sa monthly niining installment
            $unpaid  = max(0.0, $due - $i['paid']);
            // Months late karon (wala pa bayri/kulang)
            $monthsLateToday = max(0, $this->monthsBetween($i['due_date'], $today));
            // Dugang nga penalty hangtod karon (para lang sa unpaid)
            $extra   = $unpaid > 0
                ? $this->penalty($unpaid, $penaltyRate) * max(0, $monthsLateToday - $i['months_late'])
                : 0.0;

            // Penalty = na-accrue na + dugang hangtod karon
            $penalty = $i['pen_accrued'] + $extra;
            // Overdue = kung milapas na ang due date: due + penalty - nabayran (dili mubu sa 0)
            $overdue = $today->gt($i['due_date'])
                ? max(0.0, $due + $penalty - $i['paid'] - $i['pen_paid'])
                : 0.0;

            $cumPaid       += $i['paid'];        // idugang sa running paid
            $cumPen        += $penalty;          // idugang sa running penalty
            $cumPenPaid    += $i['pen_paid'];    // idugang sa running penalty paid
            $totalPrinPaid += $i['prin_paid'];   // idugang sa total principal paid

            // Total Amount Due: apil lang ang installments nga due na (due date <= karon)
            if ($i['due_date']->lte($today)) {
                $amountDue += $due + $penalty - $i['paid'] - $i['pen_paid'];
            }

            // Ang row sa ledger
            $rows[] = [
                'installment_no' => $n,
                'due_date'       => $i['due_date']->toDateString(),
                'monthly_due'    => round($due, 2),                // Monthly Installment
                'principal'      => round($mPrin, 2),              // Monthly Principal
                'interest'       => round($mInt, 2),               // Monthly Interest
                'penalty'        => round($penalty, 2),            // Penalty
                'rebate'         => round($i['rebate'], 2),        // Rebate
                'paid'           => round($i['paid'], 2),          // Monthly Installment Paid
                'principal_paid' => round($i['prin_paid'], 2),     // Monthly Principal Paid
                'interest_paid'  => round($i['int_paid'], 2),      // Monthly Interest Paid
                'penalty_paid'   => round($i['pen_paid'], 2),      // Penalty Paid
                'overdue'        => round($overdue, 2),            // Overdue
                // Running Balance without Penalty
                'balance_no_pen' => round(max(0.0, $base - $cumPaid), 2),
                // Running Balance with Penalty
                'balance_w_pen'  => round(max(0.0, $base - $cumPaid + $cumPen - $cumPenPaid), 2),
                // Detalye sa penalty (para sa tooltip; dili makaapekto sa resulta)
                'penalty_accrued'   => round($i['pen_accrued'], 2),   // penalty nga na-accrue na sa mga payment
                'unpaid'            => round($unpaid, 2),             // monthly nga wala pa bayri
                'months_late_today' => $monthsLateToday,              // bulan nga late hangtod karon
                'extra_months'      => $unpaid > 0 ? max(0, $monthsLateToday - $i['months_late']) : 0,
                'extra_penalty'     => round($extra, 2),              // dugang nga penalty hangtod karon
                'penalty_per_month' => $unpaid > 0 ? $this->penalty($unpaid, $penaltyRate) : 0.0,
                'payments'       => $i['payments'],                // Payment Breakdown
            ];
        }

        // Current Balance = Running Balance with Penalty sa pinakaulahing row
        $balance = $rows ? end($rows)['balance_w_pen'] : 0.0;

        // ============================================================
        // STEP 4: I-return ang tanan
        // ============================================================
        return [
            'current_balance'   => $balance,                    // Current Balance
            'total_balance_due' => $balance,                    // Total Balance Due (parehas ra)
            'total_amount_due'  => round(max(0.0, $amountDue), 2),   // Total Amount Due
            'total_payments'    => round((float) $payments->sum('amount'), 2),  // cash lang, walay rebate
            'total_penalty'     => round($cumPen, 2),           // tanang penalty
            // Unrecovered Cost = Financed Amount - Principal Paid (dili mubu sa 0)
            'unrecovered_cost'  => round(max(0.0, (float) ($installment->financed_amount ?? 0) - $totalPrinPaid), 2),
            // Loan Status
            'status'            => $balance <= 0 ? 'Fully Paid'
                : ($rows && $today->gt(Carbon::parse(end($rows)['due_date'])) ? 'Past Term' : 'Active'),
            'installments'      => $rows,          // mga row sa Loan Ledger
            'payments'          => $paymentRows,   // mga row sa Payment History
        ];
    }

    /**
     * Installment no. sa "current due" nga makakuha sa rebate:
     * 1) ang installment nga ang due date naa sa bulan sa payment (pananglitan due Oct 3, payment Oct 2),
     * 2) kung wala, ang sunod nga due date human sa payment,
     * 3) kung wala gihapon, ang katapusang installment.
     */
    private function rebateTarget(array $inst, Carbon $paidAt): int
    {
        $upcoming = null;
        foreach ($inst as $n => $x) {
            if ($x['due_date']->year === $paidAt->year && $x['due_date']->month === $paidAt->month) {
                return $n;
            }
            if ($upcoming === null && $x['due_date']->gt($paidAt)) {
                $upcoming = $n;
            }
        }
        return $upcoming ?? array_key_last($inst);
    }

    /**
     * Penalty kada bulan nga late = 4% sa unpaid, gi-round up sa buok nga numero.
     * round(..., 6) una para dili masaypan sa float (pananglitan 250.00000000000003).
     */
    private function penalty(float $unpaid, float $penaltyRate): float
    {
        return ceil(round($unpaid * $penaltyRate, 6));   // pananglitan 2,313 x 4% = 92.52 -> 93
    }

    /**
     * Buok nga bulan gikan sa due date hangtod sa usa ka petsa.
     * Kung wala pa moabot ang adlaw sa bulan, minus 1 (parehas sa workbook).
     */
    private function monthsBetween(Carbon $due, Carbon $date): int
    {
        return ($date->year - $due->year) * 12            // diperensya sa tuig, ibalhin sa bulan
             + ($date->month - $due->month)               // dugang ang diperensya sa bulan
             - ($date->day < $due->day ? 1 : 0);          // minus 1 kung wala pa moabot ang adlaw
    }
}
