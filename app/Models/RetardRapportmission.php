<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetardRapportmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'projet_id',
        'employe_id',
        'mission_id',
        'nom_mission'
    ];
}
