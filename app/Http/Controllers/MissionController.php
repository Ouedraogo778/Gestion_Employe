<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\AttributionMission;
use App\Models\Employe;
use App\Models\Mission;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:mission-liste|mission-ajouter|mission-modifier|mission-supprimer', ['only' => ['index', 'show']]);
        $this->middleware('permission:mission-ajouter', ['only' => ['create', 'store']]);
        $this->middleware('permission:mission-modifier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mission-supprimer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions = Mission::latest()->paginate(25);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        return view('missions.index', compact('missions', 'listeprojets', 'listeemployes'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();

        return view('missions.create', compact('listeprojets', 'listeemployes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'projet_id',
            'employe_id',
            'code' => 'unique:missions,code',
            'nom',
            'pdf_file1' => 'nullable|mimes:pdf,docx,xls,xlsx|max:4096',
            'objectif',
            'budget',
            'localite',
            'description',
            'datedebut',
            'datefin',
            'validation_finance',
            'validation_raf',
            'validation_supperieur',
            'statut1',
            'statut2',
            'statut3',
            'statut4',
            'statut5',
            'statut6',
            'statutfin',
            'enregistrer',

        ], [
            'code.unique' => 'Ce code mission est dejà utlisé.',
        ]);

        $recuNomEmploye = $request->input('employe_id');

        $nombre = AttributionMission::where('nom_employe', $recuNomEmploye)->count();

        if ($nombre <= 1) {
            DB::beginTransaction();

            try {
                // Enregistrement dans la table activite

                $mission = new Mission();
                $mission->projet_id = $request->projet_id;
                $mission->employe_id = $request->employe_id;
                $mission->code = $request->code;
                $mission->nom = $request->nom;
                // Gérer le fichier PDF s'il est présent dans la requête
              
                if ($request->hasFile('pdf_file1')) {
                    $uploadedFile = $request->file('pdf_file1');
                    $fileMimeType = $uploadedFile->getClientMimeType();
                
                    // Vérifier si le fichier est un PDF, un Word ou un Excel
                    if (in_array($fileMimeType, ['application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
                        // Stocker le fichier dans le répertoire approprié en fonction du type de fichier
                        $directory = '';
                        if ($fileMimeType === 'application/pdf') {
                            $directory = 'pdfs';
                        } elseif ($fileMimeType === 'application/vnd.ms-excel' || $fileMimeType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                            $directory = 'excels';
                        } elseif ($fileMimeType === 'application/msword' || $fileMimeType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                            $directory = 'words';
                        }
                
                        $filePath = $uploadedFile->store($directory, 'public');
                        $mission->pdf_odremission = $filePath;
                        
                        // ... (le reste du code)
                    } else {
                        // Type de fichier non pris en charge
                        return redirect()->back()->with('error', 'Type de fichier non pris en charge. Veuillez télécharger un fichier PDF, Word ou Excel.');
                    }
                }
                // Gérer le fichier PDF s'il est présent dans la requête
                // if ($request->hasFile('pdf_file2')) {
                //     $pdfPath = $request->file('pdf_file2')->store('pdfs', 'public');
                //     $mission->pdf_besoin = $pdfPath;
                // }
                $mission->objectif = $request->objectif;
                $mission->budget = $request->budget;
                $mission->localite = $request->localite;
                $mission->description = $request->description;
                $mission->datedebut = $request->datedebut;
                $mission->datefin = $request->datefin;
                $mission->validation_finance = $request->validation_finance;
                $mission->validation_raf = $request->validation_raf;
                $mission->validation_supperieur = $request->validation_supperieur;
                $mission->statut1 = $request->statut1;
                $mission->statut2 = $request->statut2;
                $mission->statut3 = $request->statut3;
                $mission->statut4 = $request->statut4;
                $mission->statut5 = $request->statut5;
                $mission->statut6 = $request->statut6;
                $mission->statutfin = $request->statutfin;
                $mission->enregistrer = $request->enregistrer;

                $mission->save();

                // Enregistrement dans la table attributionactivite
                $attribution = new AttributionMission();
                $attribution->nom_employe = $request->input('employe_id'); // Remplacez par le champ correct de la table Autre
                $attribution->code_mission = $request->input('code'); // Remplacez par le champ correct de la table Autre
                $attribution->save();

                // Valider et exécuter la transaction si tout s'est bien passé
                DB::commit();

                // Redirection avec un message de succès (vous pouvez modifier la redirection selon vos besoins)
                return redirect()->route('missions.create')->with('success', 'Mission enregistrée avec succès.');
            } catch (\Exception $e) {
                // En cas d'erreur, annuler la transaction et retourner à la page précédente avec un message d'erreur
                DB::rollback();
                return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement des données.');
            }
        } else {
            return redirect()->route('missions.create')->with('error', "l'employé est déja en mission");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mission = Mission::find($id);
        return view('missions.show', compact('mission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */


    // --------------- debut afficher la page Modifier ------------------------

    public function edit($id)
    {
        //dd($id);
        $mission = Mission::find($id);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        return view('missions.edit', compact('mission', 'listeprojets', 'listeemployes'));
    }

    // --------------- fin afficher la page   Modifier ------------------------

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */

    // --------------- debut du traitement de la  Modifier ------------------------

    public function update(Request $request, $id)
    {
        request()->validate([

            'projet_id',
            'employe_id',
            'code',
            'nom',
            'pdf_tdr' => 'nullable|mimes:pdf|max:4096',
            'objectif',
            'budget',
            'localite',
            'description',
            'datedebut',
            'datefin',
            'statut1',
            'statut2',
            'statut3',
            'statut4',
            'statut5',
            'statut6',
            'modifier',
        ]);
        $mission = Mission::find($id);
        $mission->projet_id = $request->input('projet_id');
        $mission->employe_id = $request->input('employe_id');
        $mission->code = $request->input('code');
        $mission->nom = $request->input('nom');
        // Traitement du nouveau fichier PDF
        if ($request->hasFile('nouveau_pdf1')) {
            // Supprimer l'ancien fichier s'il existe
            if ($mission->pdf_odremission) {
                Storage::delete($mission->pdf_odremission);
            }
        
            // Enregistrer le nouveau fichier
            $pdfPath = $request->file('nouveau_pdf1')->store('pdfs', 'public');
            $mission->update(['pdf_odremission' => $pdfPath]);
        }
        
        // Traitement du nouveau fichier PDF
        //  if ($request->hasFile('nouveau_pdf2')) {
        //     // Supprimer l'ancien fichier PDF s'il existe
        //     Storage::delete($mission->pdf_besoin);

        //     // Enregistrer le nouveau fichier PDF
        //     $pdfPath = $request->file('nouveau_pdf2')->store('pdfs', 'public');
        //     $activite->update(['pdf_besoin' => $pdfPath]);
        // }
        $mission->objectif = $request->input('objectif');
        $mission->budget = $request->input('budget');
        $mission->localite = $request->input('localite');
        $mission->description = $request->input('description');
        $mission->datedebut = $request->input('datedebut');
        $mission->datefin = $request->input('datefin');
        $mission->modifier = $request->input('modifier');
        $mission->save();

        return redirect()->route('missions.index')
            ->with('success', 'Mission modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mission = Mission::find($id);
        $mission->delete();

        return redirect()->route('missions.index')
            ->with('success', 'Mission supprimée avec succès');
    }
}
