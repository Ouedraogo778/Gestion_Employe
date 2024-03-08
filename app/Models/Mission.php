<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    protected $fillable = [
        'projet_id',
        'employe_id',
        'code',
        'nom',
        'pdf_odremission',
        'objectif',
        'budget',
        'localite',
        'description',
        'datedebut',
        'datefin',
        'validation_finance',
        'validation_raf',
        'validation_supperieur',
        'statut1',
        'statut2',
        'motif1',
        'statut3',
        'statut4',
        'motif2',
        'statut5',
        'statut6',
        'motif3',
        'statutfin',
        'enregistrer',
        'modifier'

    ];
    public function projet(){
        // return $this->belongsTo(Projet::class);
        return $this->belongsTo(Projet::class, 'projet_id');
    }
    public function employe(){
        // return $this->belongsTo(Employe::class);
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    public function rmission(){
        return $this->hasMany(Rmission::class);
    }
}
