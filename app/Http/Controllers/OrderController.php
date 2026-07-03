<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer','payments'])
            ->orderByDesc('order_date')
            ->paginate(20);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $order = new Order([
            'order_date' => now()->toDateString(),
            'status' => 'Presupuesto',
            'cost' => 0,
        ]);

        return view('orders.create', compact('customers', 'order'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'nullable|date',
            'project' => 'nullable|max:255',
            'room' => 'nullable|max:255',
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'delivery_date' => 'nullable|date',
            'status' => 'required|max:50',
            'notes' => 'nullable',
        ]);

        $validated['order_date'] = $validated['order_date'] ?: now()->toDateString();
        $validated['cost'] = $validated['cost'] ?? 0;

        $order = Order::create($validated);

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Pedido creado.');
    }

    public function show(Order $order)
    {
        $order->load(['customer','payments' => function ($query) {
            $query->orderByDesc('payment_date');
        }]);

        return view('orders.show', compact('order'));
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
            'order_date' => 'nullable|date',
            'project' => 'nullable|max:255',
            'room' => 'nullable|max:255',
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'delivery_date' => 'nullable|date',
            'status' => 'required|max:50',
            'notes' => 'nullable',
        ]);

        $validated['order_date'] = $validated['order_date'] ?: now()->toDateString();
        $validated['cost'] = $validated['cost'] ?? 0;

        $order->update($validated);

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Pedido actualizado.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pedido eliminado.');
    }
}
