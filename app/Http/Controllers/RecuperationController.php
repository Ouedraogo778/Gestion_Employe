<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Mission;
use Illuminate\Http\Request;

class RecuperationController extends Controller
{
    public function getNomEmploye($codeActivite)
    {
        // Récupérer les informations nécessaires depuis votre modèle
        $infoEmployeProjet = Activite::where('code', $codeActivite)->first();

        // Retourner la réponse au format JSON
        return response()->json([
            'nomEmploye' => $infoEmployeProjet->employe_id,
            'codeProjet' => $infoEmployeProjet->projet_id,
        ]);
    }


    public function getNomEmployes($codeMission)
    {
        // Récupérer les informations nécessaires depuis votre modèle
        $infoEmployeProjet = Mission::where('code', $codeMission)->first();

        // Retourner la réponse au format JSON
        return response()->json([
            'nomEmploye' => $infoEmployeProjet->employe_id,
            'codeProjet' => $infoEmployeProjet->projet_id,
        ]);
    }
}
