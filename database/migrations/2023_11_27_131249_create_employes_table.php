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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->String('nom_prenom')->nullable();
            $table->String('datenaissance')->nullable();
            $table->String('genre')->nullable();
            $table->String('telephone')->nullable();
            $table->String('email')->nullable();
            $table->String('poste')->nullable();
            $table->String('dateembauche')->nullable();
            $table->String('enregistrer')->nullable();
            $table->String('modifier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
