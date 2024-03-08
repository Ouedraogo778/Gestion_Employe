<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('champs_supplementaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ractivite_id');
            $table->string('libelle');
            $table->integer('montant');
            $table->timestamps();

            $table->foreign('ractivite_id')->references('id')->on('ractivite')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('champs_supplementaires');
    }
};
