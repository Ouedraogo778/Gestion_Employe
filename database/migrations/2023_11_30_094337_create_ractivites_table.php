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
        Schema::create('ractivites', function (Blueprint $table) {
            $table->id();
            $table->string('projet_id');// clé primaire du projet
            $table->string('employe_id');// clé primaire de l'employe
            $table->String('activite_id')->nullable();
            $table->text('pdf_ractivite')->nullable();
            $table->text('piece1')->nullable();
            $table->integer('montant1')->nullable();
            $table->text('piece2')->nullable();
            $table->integer('montant2')->nullable();
            $table->text('piece3')->nullable();
            $table->integer('montant3')->nullable();
            $table->integer('sommeTotale')->nullable();
            $table->text('datechargement')->nullable();
            $table->string('validation_finance')->nullable();
            $table->string('validation_raf')->nullable();
            $table->string('validation_supperieur')->nullable();
            $table->string('statut1')->nullable();
            $table->string('statut2')->nullable();
            $table->text('motif1')->nullable();
            $table->string('statut3')->nullable();
            $table->string('statut4')->nullable();
            $table->text('motif2')->nullable();
            $table->string('statut5')->nullable();
            $table->string('statut6')->nullable();
            $table->text('motif3')->nullable();
            
            $table->text('enregistrer')->nullable();
            $table->text('modifier')->nullable();
            $table->timestamps();

            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->foreign('employe_id')->references('id')->on('employes');
            $table->foreign('activite_id')->references('id')->on('activites');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ractivites');
    }
};
