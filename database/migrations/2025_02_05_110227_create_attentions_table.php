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
        if(!Schema::hasTable('attentions')){
            Schema::create('attentions', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('customer_id');
                $table->string('document_type', 4)->nullable();
                $table->string('sunat_code', 5);
                $table->string('document_code', 20);
                $table->string('reference _document', 18)->nullable();
                $table->unsignedTinyInteger('currency');
                // $table->('product_id'=>0, //$attention->order_id,
                // $table->('amount'=> 0, //$attention->amount,
                // $table->('price'=> 0, //$attention->price,
                $table->double('total', 8,2);
                $table->unsignedInteger('seller');
                $table->unsignedSmallInteger('serie')->default(1);
                $table->unsignedInteger('numeration');
                $table->string('identifier', 20)->nullable();
                $table->string('hash', 50)->nullable();
                $table->string('resume', 249)->nullable(); 
                $table->string('cdr', 5)->nullable();
                $table->string('message', 249)->nullable();
                $table->string('low_motive', 200)->nullable();
                $table->unsignedTinyInteger('low')->default(0); 
                $table->unsignedTinyInteger('guide')->default(0);  
                $table->unsignedTinyInteger('success')->nullable(); 
                $table->unsignedTinyInteger('dispatched')->default(0); 
                $table->unsignedTinyInteger('received')->default(0);
                $table->unsignedTinyInteger('completed')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attentions');
    }
};
