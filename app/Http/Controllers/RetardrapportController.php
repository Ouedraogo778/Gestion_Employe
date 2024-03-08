<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Employe;
use App\Models\Projet;
use App\Models\RetardRapport;
use App\Models\RetardRapportmission;
use Illuminate\Http\Request;

class RetardrapportController extends Controller
{
    public function index()
    {
        $retardactivites = RetardRapport::latest()->paginate(25);
        
        return view('Listeretard.retardactivite', compact('retardactivites'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function index2()
    {
        $retardrapportmissions = RetardRapportmission::latest()->paginate(25);
        
        return view('Listeretard.retardmission', compact('retardrapportmissions'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }
}
