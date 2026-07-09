<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $monthStart = Carbon::now()->startOfMonth()->toDateString();
        $monthEnd = Carbon::now()->endOfMonth()->toDateString();

        $ordersMonth = Order::whereBetween('order_date', [$monthStart, $monthEnd])->get();
        $salesMonth = $ordersMonth->sum(fn (Order $order) => $order->price_ars);
        $profitMonth = $ordersMonth->sum(fn (Order $order) => $order->profit_ars);

        $paymentsMonth = Payment::whereBetween('payment_date', [$monthStart, $monthEnd])
            ->get()
            ->sum(fn (Payment $payment) => $payment->amount_ars);

        $expensesMonth = Expense::whereBetween('expense_date', [$monthStart, $monthEnd])
            ->get()
            ->sum(fn (Expense $expense) => $expense->amount_ars);

        $totalSold = Order::all()->sum(fn (Order $order) => $order->price_ars);
        $totalCollected = Payment::all()->sum(fn (Payment $payment) => $payment->amount_ars);
        $totalExpenses = Expense::all()->sum(fn (Expense $expense) => $expense->amount_ars);

        $totalPending = $totalSold - $totalCollected;
        $cashBalance = $totalCollected - $totalExpenses;

        return view('dashboard', [
            'customersCount' => Customer::count(),
            'ordersCount' => Order::count(),
            'salesMonth' => $salesMonth,
            'paymentsMonth' => $paymentsMonth,
            'expensesMonth' => $expensesMonth,
            'profitMonth' => $profitMonth,
            'resultMonth' => $paymentsMonth - $expensesMonth,
            'totalPending' => $totalPending,
            'cashBalance' => $cashBalance,
            'latestOrders' => Order::with('customer')->orderByDesc('order_date')->orderByDesc('id')->take(6)->get(),
            'latestPayments' => Payment::with('order.customer')->latest('payment_date')->take(6)->get(),
            'upcomingOrders' => Order::with('customer')
                ->whereNotNull('delivery_date')
                ->where('delivery_date', '>=', Carbon::today()->toDateString())
                ->orderBy('delivery_date')
                ->take(6)
                ->get(),
        ]);
    }
}
