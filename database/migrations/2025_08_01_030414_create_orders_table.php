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
        Schema::create('orders', function (Blueprint $table) {
           $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('delivery_id');
            $table->decimal('total_price', 10, 2);
            $table->enum('state',['pending','on_the_way','delivered']);
            $table->timestamps();
            $table->uuid('currency_id');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('delivery_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('currency_id')
                  ->references('id')
                  ->on('currencies')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
