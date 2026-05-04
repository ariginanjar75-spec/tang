<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index()
    {
        $debts = Debt::orderBy('created_at', 'desc')->get();
        return view('debts.index', compact('debts'));
    }

    public function create()
    {
        return view('debts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'selected_tenor' => 'required|integer|in:3,6,8,12',
            'monthly_installment' => 'required|numeric|min:0',
        ]);

        Debt::create($request->all());

        return redirect()->route('debts.index')->with('success', 'Debt recorded successfully!');
    }

    public function update(Request $request, Debt $debt)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $debt->update([
            'description' => $request->description,
            'total_amount' => $request->total_amount,
            'monthly_installment' => $request->total_amount / $debt->selected_tenor,
        ]);

        return redirect()->back()->with('success', 'Debt updated successfully!');
    }

    public function topUp(Request $request, Debt $debt)
    {
        $request->validate([
            'additional_amount' => 'required|numeric|min:0',
        ]);

        $newTotal = $debt->total_amount + $request->additional_amount;
        
        $debt->update([
            'total_amount' => $newTotal,
            'monthly_installment' => $newTotal / $debt->selected_tenor,
        ]);

        return redirect()->back()->with('success', 'Debt topped up successfully!');
    }

    public function destroy(Debt $debt)
    {
        $debt->delete();
        return redirect()->back()->with('success', 'Debt deleted successfully!');
    }
}
