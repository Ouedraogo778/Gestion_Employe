<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributionMission extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_employe',
        'code_mission'
  
    ];
}
