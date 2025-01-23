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
        Schema::create('log_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('customer_id');
            $table->string('document_code', 17)->nullable();
            $table->string('identifier', 20)->nullable();
            $table->double('total', 8,2);
            $table->string('hash', 50)->nullable();
            $table->string('resume', 100)->nullable();
            $table->string('cdr', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_receipts');
    }
};
