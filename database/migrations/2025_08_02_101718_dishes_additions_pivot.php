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
       Schema::create('dishes_additions_pivot', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('additions_id');
            $table->uuid('dishes_id');

            $table->foreign('additions_id')
                ->references('id')
                ->on('additions')
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
