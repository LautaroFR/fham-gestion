<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('project')->nullable();

            $table->string('room')->nullable();

            $table->string('title');

            $table->decimal('price',15,2);

            $table->decimal('cost',15,2)->default(0);

            $table->date('delivery_date')->nullable();

           $table->string('status')->default('Presupuesto');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};