<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Departement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'pdf_path',
        'enregistrer',
        'modifier'

    ];

    public function projets():BelongsToMany
    {
        return $this->belongsToMany(Projet::class);
    }


    //configuration pour la table pivot de departement_partenaire

    public function absences():BelongsToMany
    {
        return $this->belongsToMany(Absence::class);
    }

}
