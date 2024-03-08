<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ractivite extends Model
{
    use HasFactory;
    protected $fillable = [
        'projet_id',
        'employe_id',
        'activite_id',
        'pdf_ractivite',
        'sommeTotale',
        'piece1',
        'montant1',
        'piece2',
        'montant2',
        'piece3',
        'montant3',
        'datechargement',
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

    public function activite(){
        // return $this->belongsTo(Employe::class);
        return $this->belongsTo(Activite::class, 'activite_id');
    }

    public function champsSupplementaires() {
        return $this->hasMany(ChampsSupplementaire::class);
        
    }
    
}
