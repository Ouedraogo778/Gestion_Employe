<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $fillable = [

        'codeprojet',
        'nom',
        'datedebut',
        'datefin',
        'datecreation',
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
