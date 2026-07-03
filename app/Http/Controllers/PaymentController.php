<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.customer')
            ->orderByDesc('payment_date')
            ->paginate(20);

        return view('payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $orders = Order::with('customer')
            ->orderByDesc('order_date')
            ->get();

        $selectedOrder = null;

        if ($request->filled('order_id')) {
            $selectedOrder = Order::with('customer')->find($request->order_id);
        }

        $payment = new Payment([
            'order_id' => $request->order_id,
            'payment_date' => now()->toDateString(),
        ]);

        return view('payments.create', compact('orders', 'payment', 'selectedOrder'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'method' => 'nullable|max:100',
            'reference' => 'nullable|max:255',
            'notes' => 'nullable',
        ]);

        $payment = Payment::create($validated);

        return redirect()
            ->route('orders.show', $payment->order_id)
            ->with('success', 'Cobro registrado.');
    }

    public function edit(Payment $payment)
    {
        $orders = Order::with('customer')
            ->orderByDesc('order_date')
            ->get();

        return view('payments.edit', compact('payment','orders'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'method' => 'nullable|max:100',
            'reference' => 'nullable|max:255',
            'notes' => 'nullable',
        ]);

        $payment->update($validated);

        return redirect()
            ->route('orders.show', $payment->order_id)
            ->with('success', 'Cobro actualizado.');
    }

    public function destroy(Payment $payment)
    {
        $orderId = $payment->order_id;

        $payment->delete();

        return redirect()
            ->route('orders.show', $orderId)
            ->with('success', 'Cobro eliminado.');
    }
}
