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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 95);
            $table->string('tipo_doc', 10)->nullable();
            $table->string('document', 30)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('address', 140)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('ubigeo', 50)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
