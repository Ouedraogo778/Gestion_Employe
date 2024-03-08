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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->String('codeprojet')->nullable();
            $table->String('nom')->nullable();
            $table->String('datedebut')->nullable();
            $table->String('datefin')->nullable();
            $table->String('datecreation')->nullable();
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
        Schema::dropIfExists('projets');
    }
};
