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
        Schema::create('temp__orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('table_id')->default(1);
            $table->unsignedInteger('order_id');
            $table->decimal('amount', 8, 2);
            $table->unsignedTinyInteger('status')->nullable()->default(1);
            $table->unsignedInteger('business_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp__orders');
    }
};
