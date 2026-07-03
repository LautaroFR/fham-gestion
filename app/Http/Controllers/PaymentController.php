<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.customer')->latest('payment_date')->paginate(20);
        return view('payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $orders = Order::with('customer')->orderByDesc('created_at')->get();
        $selectedOrder = $request->get('order_id');
        return view('payments.create', compact('orders', 'selectedOrder'));
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

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'Cobro registrado.');
    }

    public function edit(Payment $payment)
    {
        $orders = Order::with('customer')->orderByDesc('created_at')->get();
        return view('payments.edit', compact('payment', 'orders'));
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

        return redirect()->route('payments.index')->with('success', 'Cobro actualizado.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Cobro eliminado.');
    }
}
