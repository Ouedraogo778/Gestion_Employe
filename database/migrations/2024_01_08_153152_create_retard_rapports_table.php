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
        Schema::create('retard_rapports', function (Blueprint $table) {
            $table->id();
            $table->string('projet_id')->nullable();
            $table->string('employe_id')->nullable();
            $table->string('activite_id')->nullable();
            $table->string('nom_activite')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retard_rapports');
    }
};
