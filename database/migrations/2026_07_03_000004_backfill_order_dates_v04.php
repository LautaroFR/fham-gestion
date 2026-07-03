<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('orders', 'order_date')) {
            DB::table('orders')
                ->whereNull('order_date')
                ->update(['order_date' => DB::raw('DATE(created_at)')]);
        }

        if (Schema::hasColumn('payments', 'payment_date')) {
            DB::table('payments')
                ->whereNull('payment_date')
                ->update(['payment_date' => DB::raw('DATE(created_at)')]);
        }
    }

    public function down(): void
    {
        //
    }
};
