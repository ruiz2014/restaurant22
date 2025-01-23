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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 245)->nullable();
            $table->unsignedTinyInteger('product_type')->nullable()->default(1);
            $table->unsignedTinyInteger('group')->nullable()->default(1);
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('category_id')->default(1);
            $table->unsignedInteger('provider_id')->default(1);
            $table->decimal('stock', 8,2)->nullable();
            $table->decimal('minimo', 6,2)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
