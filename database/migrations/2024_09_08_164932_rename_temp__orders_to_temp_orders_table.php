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
        // Schema::table('temp_orders', function (Blueprint $table) {
        //     //
        // });
        Schema::rename('temp__orders', 'temp_orders');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temp_orders', function (Blueprint $table) {
            //
        });
    }
};
