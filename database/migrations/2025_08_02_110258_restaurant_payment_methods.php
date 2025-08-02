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
           Schema::create('restaurant_payment_methods', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('restaurants_id');
            $table->enum('payment_type', ['mtn cash', 'syriatel cash', 'cash mobile']);
            $table->VARCHAR('account_number',255);
            $table->boolean('is_active');

            $table->foreign('restaurants_id')
                ->references('id')
                ->on('restaurants')
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
