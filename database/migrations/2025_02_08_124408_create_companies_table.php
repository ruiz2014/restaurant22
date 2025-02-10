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
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 249); 
            $table->string('ruc', 12);
            $table->string('trade_name', 249); 
            $table->string('user_sol', 20)->nullable(); 
            $table->string('pass_sol', 80)->nullable(); 
            $table->string('business_description', 250)->nullable(); 
            $table->string('address', 249); 
            $table->string('ubigeo', 10)->nullable(); 
            $table->string('company_code', 20); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
