<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard',[
            'customers'=>Customer::count(),
            'orders'=>Order::count(),
            'payments'=>Payment::sum('amount'),
            'expenses'=>Expense::sum('amount'),
        ]);
    }
}