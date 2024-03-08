<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Employe;
use App\Models\Mission;
use App\Models\Projet;
use Illuminate\Http\Request;

class FactiviteController extends Controller
{
    public function filtreactivite($codeprojet)
    {
        $activites = Activite::where('projet_id', $codeprojet)->latest()->paginate(25);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        return view('filtre.filtreactivite', compact('activites', 'listeprojets', 'listeemployes'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }


    public function filtremission($codeprojet)
    {
        $missions = Mission::where('projet_id', $codeprojet)->latest()->paginate(25);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        return view('filtre.filtremission', compact('missions', 'listeprojets', 'listeemployes'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }


}
