<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = [

        'nom_prenom',
        'datenaissance',
        'genre',
        'telephone',
        'email',
        'poste',
        'dateembauche',
        'enregistrer',
        'modifier'
    ];
    public function activites(){
        return $this->hasMany(Activite::class);
    }

    public function missions(){
        return $this->hasMany(Mission::class);
    }

    public function ractivites(){
        return $this->hasMany(Ractivite::class);
    }

    public function rmission(){
        return $this->hasMany(Rmission::class);
    }
}
