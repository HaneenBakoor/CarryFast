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
         Schema::create('dishes_restaurants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('restaurants_id');
            $table->uuid('dishes_id');

            $table->foreign('restaurants_id')
                ->references('id')
                ->on('restaurants')
                ->onDelete('restrict');

                 $table->foreign('dishes_id')
                ->references('id')
                ->on('dishes')
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
