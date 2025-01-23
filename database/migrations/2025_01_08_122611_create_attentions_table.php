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
        Schema::create('attentions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedTinyInteger('document_type');
            $table->string('sunat_code', 4);
            $table->string('document_code', 17)->nullable();
            $table->string('reference _document', 17)->nullable();
            $table->unsignedTinyInteger('currency');
            $table->unsignedInteger('product_id');
            $table->float('amount', 4,1);
            $table->double('price', 8,2);
            $table->double('total', 8,2);
            $table->unsignedInteger('seller');
            $table->smallInteger('serie')->default(1);
            $table->string('identifier', 20)->nullable();
            $table->unsignedInteger('numeration');
            // $table->('date') timestamp NOT NULL DEFAULT current_timestamp(),
            $table->string('hash', 50)->nullable();
            $table->string('resume', 100)->nullable();
            $table->string('cdr', 5)->nullable();
            $table->unsignedTinyInteger('success')->nullable();
            $table->string('message', 70)->nullable();
            $table->string('low_motive', 200)->nullable();
            $table->unsignedTinyInteger('low')->default(0);
            $table->unsignedTinyInteger('guide')->default(0);
            $table->unsignedTinyInteger('completed')->default(0);
            $table->unsignedTinyInteger('dispatched')->default(0);
            $table->unsignedTinyInteger('received')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attentions');
    }
};
