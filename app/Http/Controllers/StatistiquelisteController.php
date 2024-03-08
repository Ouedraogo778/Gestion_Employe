<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\AttributionActivite;
use App\Models\Employe;
use App\Models\Mission;
use App\Models\Projet;
use App\Models\Ractivite;
use App\Models\Rmission;
use Illuminate\Http\Request;

class StatistiquelisteController extends Controller
{
    //activite en cours


public function activiteliste()
{
    // Effectuer la jointure avec la table attribution_activites et filtrer par statutfin
    $activites = Activite::join('attribution_activites', 'activites.code', '=', 'attribution_activites.code_activite')
        ->where('activites.statutfin', 1)
        ->paginate(25); // Paginer les résultats directement

    // Charger la liste des projets et des employés comme vous l'aviez fait auparavant
    $listeprojets = Projet::all();
    $listeemployes = Employe::all();

    // Passer les variables à la vue
    return view('statistiqueliste.activiteliste', compact('activites', 'listeprojets', 'listeemployes'))
        ->with('i', (request()->input('page', 1) - 1) * 25);
}



//Mission en cours



public function missionlistecours()
{
    // Effectuer la jointure avec la table attribution_activites et filtrer par statutfin
    $missions = Mission::join('attribution_missions', 'missions.code', '=', 'attribution_missions.code_mission')
        ->where('missions.statutfin', 1)
        ->paginate(25); // Paginer les résultats directement

    // Charger la liste des projets et des employés comme vous l'aviez fait auparavant
    $listeprojets = Projet::all();
    $listeemployes = Employe::all();

    // Passer les variables à la vue
    return view('statistiqueliste.missionlistecours', compact('missions', 'listeprojets', 'listeemployes'))
        ->with('i', (request()->input('page', 1) - 1) * 25);
}

// liste des activités executés

 public function activiteexecuterliste()
 {
     $ractivites = Ractivite::latest();

     //  filtre pour statutfin pour les activites executés
     $ractivites->where('statut3', 1);

     $ractivites = $ractivites->paginate(25);
     $listeprojets = Projet::all();
     $listeemployes = Employe::all();

     return view('statistiqueliste.activiteexecuterliste', compact('ractivites', 'listeprojets', 'listeemployes'))
         ->with('i', (request()->input('page', 1) - 1) * 25);
 }

//liste des activités filitrer en fonction du statut3 dans la table ractivites



// liste des missions executées

public function missionexecuterliste()
{
    $rmissions = Rmission::latest();

    // Ajouter une condition de filtre pour statut6 égal à "valider"
    $rmissions->where('statut3', 1);

    $rmissions = $rmissions->paginate(25);
    $listeprojets = Projet::all();
    $listemissions = Mission::all();
    $listeemployes = Employe::all();

    return view('statistiqueliste.missionexecuterliste', compact('rmissions','listemissions', 'listeprojets', 'listeemployes'))
        ->with('i', (request()->input('page', 1) - 1) * 25);
}

}
