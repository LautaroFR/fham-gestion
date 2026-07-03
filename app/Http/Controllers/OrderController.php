<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->latest()->paginate(20);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        return view('orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'project' => 'nullable|max:255',
            'room' => 'nullable|max:255',
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'delivery_date' => 'nullable|date',
            'status' => 'required|max:50',
            'notes' => 'nullable',
        ]);

        $validated['cost'] = $validated['cost'] ?? 0;

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Pedido creado.');
    }

    public function edit(Order $order)
    {
        $customers = Customer::orderBy('name')->get();

        return view('orders.edit', compact('order', 'customers'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'project' => 'nullable|max:255',
            'room' => 'nullable|max:255',
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'delivery_date' => 'nullable|date',
            'status' => 'required|max:50',
            'notes' => 'nullable',
        ]);

        $validated['cost'] = $validated['cost'] ?? 0;

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Pedido actualizado.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pedido eliminado.');
    }
}