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
        Schema::create('offers', function (Blueprint $table) {
            $table->uuid('id')->primary();
             $table->uuid('restaurants_id');
            $table->uuid('dishes_id');
            $table->string('title');
            $table->string('description');
            $table->string('image')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->boolean('is_active');
            $table->dateTime('start_at');
            $table->dateTime('end_at');

            $table->foreign('dishes_id')
                ->references('id')
                ->on('dishes')
                ->onDelete('restrict');

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
