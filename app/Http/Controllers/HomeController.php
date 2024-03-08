<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\AttributionActivite;
use App\Models\AttributionMission;
use App\Models\Departement;
use App\Models\Mission;
use App\Models\Projet;
use App\Models\Ractivite;
use App\Models\RetardRapport;
use App\Models\RetardRapportmission;
use App\Models\Rmission;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //Generation des statistiques au niveau de l'acceuil
    public function index()
    {
          
        
            $activiteListe = Activite::where('datefin', Carbon::now()->format('d-m-Y'))->get();

            foreach ($activiteListe as $activite) {
                
                $controleactivite = Ractivite::where('activite_id', $activite->code)->exists();
            
                // Vérifier si un enregistrement pour cette activité existe déjà dans la table RetardRapport
                $existingRecord = RetardRapport::where('activite_id', $activite->code)->exists();
            
                if (!$controleactivite && !$existingRecord) {
                    // Enregistrez les autres données du projet en retard dans une autre table (par exemple, table "projets_en_retard")
                    RetardRapport::create([
                        'projet_id' => $activite->projet_id,
                        'employe_id' => $activite->employe_id,
                        'activite_id' => $activite->code,
                        'nom_activite' => $activite->nom,
                        // Ajoutez d'autres champs que vous souhaitez enregistrer
                    ]);
                }
            }
            $nombreactiviteretard= RetardRapport::count();
            if($nombreactiviteretard !=0){
                $mess="Il y a une activité dont le rapport n'est pas encore chargé";
            }
            else {
                $mess =null;
            }
            

        // gestion des mission en retard
        $missionListe = Mission::where('datefin', Carbon::now()->format('d-m-Y'))->get();

        foreach ($missionListe as $mission) {
            
            $controlemisssion = Rmission::where('mission_id', $mission->code)->exists();
        
            // Vérifier si un enregistrement pour cette activité existe déjà dans la table RetardRapport
            $existingRecord = RetardRapportmission::where('mission_id', $mission->code)->exists();
        
            if (!$controlemisssion && !$existingRecord) {
                // Enregistrez les autres données du projet en retard dans une autre table (par exemple, table "projets_en_retard")
                RetardRapportmission::create([
                    'projet_id' => $mission->projet_id,
                    'employe_id' => $mission->employe_id,
                    'mission_id' => $mission->code,
                    'nom_mission' => $mission->nom,
                    // Ajoutez d'autres champs que vous souhaitez enregistrer
                ]);
            }
        }
        $nombremissionretard= RetardRapportmission::count();
        if($nombremissionretard !=0){
            $messages="Il y a une mission dont le rapport n'est pas encore chargé";
        }
        else {
            $messages =null;
        }

        

        $users = User::count();
        $departements = Departement::count();
        //Activite en cours
       // Vérifiez si le statutfin est égal à 1 dans la table activite
$activitesFinies = Activite::where('statutfin', 1)->pluck('code');

// Vérifiez si les activités finies ont été attribuées dans la table attributionactivite
$nombreactivite = AttributionActivite::whereIn('code_activite', $activitesFinies)->count();

//mission en cours
$missionFinies = Mission::where('statutfin', 1)->pluck('code');

// Vérifiez si les activités finies ont été attribuées dans la table attributionactivite
$nombremission = AttributionMission::whereIn('code_mission', $missionFinies)->count();
       // $nombreactivite=AttributionActivite::count();
       // $nombremission=Mission::where('statutfin', 1)->count();
        $nombreractivite=Ractivite::where('statut3', 1)->count();
        $nombrermission=Rmission::where('statut3', 1)->count();
        $nombreretardactivite=RetardRapport::count();
        $nombreretardmission=RetardRapportmission::count();

       // $nombreactivite=Activite::where('statut5', 1)->count();

        return view('dashboards.accueil',compact(
            'users', 'departements','nombreactivite','nombremission','nombreractivite','nombrermission','messages','mess','nombreretardactivite','nombreretardmission'));
    }

    //liste 
    public function er ()
{
   

    // Autres traitements de la fonction...
}




}
