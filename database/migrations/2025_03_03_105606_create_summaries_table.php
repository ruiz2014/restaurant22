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
        if(!Schema::hasTable('summaries')){
        Schema::table('summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sunat_code', 10)->nullable()->default('RC');
            $table->string('hash', 50)->nullable();
            $table->date('date_created')->nullable();
            $table->date('date_sent')->nullable(); 
            $table->string('identifier', 20)->nullable();
            $table->string('ticket', 20)->nullable();
            $table->string('cdr', 5)->nullable();
            $table->tinyText('message')->nullable();  
            $table->unsignedTinyInteger('dispatched')->default(0); 
            $table->unsignedTinyInteger('received')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('summaries', function (Blueprint $table) {
            //
        });
    }
};
