<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Expense;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $salesMonth = Order::whereBetween('created_at', [$monthStart, $monthEnd])->sum('price');
        $costMonth = Order::whereBetween('created_at', [$monthStart, $monthEnd])->sum('cost');
        $paymentsMonth = Payment::whereBetween('payment_date', [$monthStart, $monthEnd])->sum('amount');
        $expensesMonth = Expense::whereBetween('expense_date', [$monthStart, $monthEnd])->sum('amount');

        $totalSold = Order::sum('price');
        $totalCollected = Payment::sum('amount');
        $totalPending = $totalSold - $totalCollected;

        return view('dashboard', [
            'customersCount' => Customer::count(),
            'ordersCount' => Order::count(),
            'salesMonth' => $salesMonth,
            'paymentsMonth' => $paymentsMonth,
            'expensesMonth' => $expensesMonth,
            'profitMonth' => $salesMonth - $costMonth,
            'totalPending' => $totalPending,
            'cashBalance' => $totalCollected - Expense::sum('amount'),
            'latestOrders' => Order::with('customer')->latest()->take(6)->get(),
            'latestPayments' => Payment::with('order.customer')->latest('payment_date')->take(6)->get(),
        ]);
    }
}
