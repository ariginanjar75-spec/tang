<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    public function store(Request $request, Debt $debt)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . $debt->remaining_balance,
            'payment_date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        $debt->repayments()->create($request->all());

        return redirect()->back()->with('success', 'Pembayaran berhasil dicatat!');
    }

    public function update(Request $request, Repayment $repayment)
    {
        $debt = $repayment->debt;
        $maxAmount = $debt->total_amount - ($debt->repayments()->sum('amount') - $repayment->amount);

        $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . $maxAmount,
            'payment_date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        $repayment->update($request->all());

        return redirect()->back()->with('success', 'Pembayaran berhasil diperbarui!');
    }

    public function destroy(Repayment $repayment)
    {
        $repayment->delete();
        return redirect()->back()->with('success', 'Pembayaran berhasil dihapus!');
    }
}
