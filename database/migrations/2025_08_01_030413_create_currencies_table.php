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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('code',['SYR','USD','TRY']);
            $table->enum('symbol',['ل.س','$','₺']);
            $table->decimal("exchange_rate",10,4);
            $table->boolean('is_default');
            $table->decimal('fuel_price_per_liter',10,4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
