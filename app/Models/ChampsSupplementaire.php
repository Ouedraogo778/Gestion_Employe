<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChampsSupplementaire extends Model
{
    use HasFactory;
    protected $fillable = ['libelle', 'montant', 'ractivite_id'];

    public function ractivites()
    {
        //return $this->belongsTo(Ractivite::class,'ractivite_id');
        return $this->hasMany('App\Models\Ractivite', 'ractivite_id');
}
}
