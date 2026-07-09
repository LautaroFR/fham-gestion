<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest('expense_date')->paginate(20);

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $expense = new Expense([
            'expense_date' => now()->toDateString(),
            'currency' => 'ARS',
        ]);

        return view('expenses.create', compact('expense'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_date' => 'required|date',
            'category' => 'required|max:255',
            'description' => 'required|max:255',
            'supplier' => 'nullable|max:255',
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|in:ARS,USD',
            'usd_rate' => 'nullable|numeric|min:0',
            'method' => 'nullable|max:100',
            'notes' => 'nullable',
        ]);

        $validated['currency'] = $validated['currency'] ?? 'ARS';
        $validated['usd_rate'] = $validated['currency'] === 'USD'
            ? ($validated['usd_rate'] ?? null)
            : null;

        Expense::create($validated);

        return redirect()->route('expenses.index')->with('success', 'Gasto registrado.');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'expense_date' => 'required|date',
            'category' => 'required|max:255',
            'description' => 'required|max:255',
            'supplier' => 'nullable|max:255',
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|in:ARS,USD',
            'usd_rate' => 'nullable|numeric|min:0',
            'method' => 'nullable|max:100',
            'notes' => 'nullable',
        ]);

        $validated['currency'] = $validated['currency'] ?? 'ARS';
        $validated['usd_rate'] = $validated['currency'] === 'USD'
            ? ($validated['usd_rate'] ?? null)
            : null;

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Gasto actualizado.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Gasto eliminado.');
    }
}
