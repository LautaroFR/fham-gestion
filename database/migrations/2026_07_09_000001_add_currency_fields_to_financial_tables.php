<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'currency')) {
                $table->string('currency', 3)->default('ARS')->after('cost');
            }

            if (!Schema::hasColumn('orders', 'usd_rate')) {
                $table->decimal('usd_rate', 15, 2)->nullable()->after('currency');
            }
        });

        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'currency')) {
                $table->string('currency', 3)->default('ARS')->after('amount');
            }

            if (!Schema::hasColumn('payments', 'usd_rate')) {
                $table->decimal('usd_rate', 15, 2)->nullable()->after('currency');
            }
        });

        Schema::table('expenses', function (Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'currency')) {
                $table->string('currency', 3)->default('ARS')->after('amount');
            }

            if (!Schema::hasColumn('expenses', 'usd_rate')) {
                $table->decimal('usd_rate', 15, 2)->nullable()->after('currency');
            }
        });

        DB::table('orders')->whereNull('currency')->update(['currency' => 'ARS']);
        DB::table('payments')->whereNull('currency')->update(['currency' => 'ARS']);
        DB::table('expenses')->whereNull('currency')->update(['currency' => 'ARS']);
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'usd_rate')) {
                $table->dropColumn('usd_rate');
            }

            if (Schema::hasColumn('orders', 'currency')) {
                $table->dropColumn('currency');
            }
        });

        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'usd_rate')) {
                $table->dropColumn('usd_rate');
            }

            if (Schema::hasColumn('payments', 'currency')) {
                $table->dropColumn('currency');
            }
        });

        Schema::table('expenses', function (Blueprint $table) {
            if (Schema::hasColumn('expenses', 'usd_rate')) {
                $table->dropColumn('usd_rate');
            }

            if (Schema::hasColumn('expenses', 'currency')) {
                $table->dropColumn('currency');
            }
        });
    }
};
