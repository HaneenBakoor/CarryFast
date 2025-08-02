<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('order_id');
            $table->uuid('payment_method_id');
            $table->enum('status', ['pending', 'paid', 'failed','refunded']);
            $table->decimal('amount',10,4);
            $table->dateTime('paid_at');

           $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict');

            $table->foreign('payment_method_id')
                ->references('id')
                ->on('restaurant_payment_methods')
                ->onDelete('restrict');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
