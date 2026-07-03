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
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_date' => 'required|date',
            'category' => 'required|max:255',
            'description' => 'required|max:255',
            'supplier' => 'nullable|max:255',
            'amount' => 'required|numeric|min:1',
            'method' => 'nullable|max:100',
            'notes' => 'nullable',
        ]);

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
            'method' => 'nullable|max:100',
            'notes' => 'nullable',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Gasto actualizado.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Gasto eliminado.');
    }
}
