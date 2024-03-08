<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\AttributionActivite;
use App\Models\Employe;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:activite-liste|activite-ajouter|activite-modifier|activite-supprimer', ['only' => ['index', 'show']]);
        $this->middleware('permission:activite-ajouter', ['only' => ['create', 'store']]);
        $this->middleware('permission:activite-modifier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:activite-supprimer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activites = Activite::latest()->paginate(25);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        return view('activites.index', compact('activites', 'listeprojets', 'listeemployes'))
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

        return view('activites.create', compact('listeprojets', 'listeemployes'));
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
            'code' => 'unique:activites,code',
            'nom',
            'pdf_file1' => 'nullable|mimes:pdf,docx,xls,xlsx|max:4096',
            'pdf_file2' => 'nullable|mimes:pdf,docx,xls,xlsx|max:4096',
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
            'code.unique' => 'Ce code activité est dejà utlisé.',
        ]);

        $recuNomEmploye = $request->input('employe_id');

        $nombre = AttributionActivite::where('nom_employe', $recuNomEmploye)->count();

        if ($nombre <= 2) {
            DB::beginTransaction();

            try {
                // Enregistrement dans la table activite
                $activite = new Activite();
                $activite->projet_id = $request->projet_id;
                $activite->employe_id = $request->employe_id;
                $activite->code = $request->code;
                $activite->nom = $request->nom;
                // Gérer le fichier PDF s'il est présent dans la requête
               
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
                $activite->pdf_tdr = $filePath;
                
                // ... (le reste du code)
            } else {
                // Type de fichier non pris en charge
                return redirect()->back()->with('error', 'Type de fichier non pris en charge. Veuillez télécharger un fichier PDF, Word ou Excel.');
            }
        }

               // Gérer le fichier PDF s'il est présent dans la requête
        if ($request->hasFile('pdf_file2')) {
            $uploadedFile = $request->file('pdf_file2');
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
                $activite->pdf_besoin = $filePath;
                
                // ... (le reste du code)
            } else {
                // Type de fichier non pris en charge
                return redirect()->back()->with('error', 'Type de fichier non pris en charge. Veuillez télécharger un fichier PDF, Word ou Excel.');
            }
        }
                $activite->objectif = $request->objectif;
                $activite->budget = $request->budget;
                $activite->localite = $request->localite;
                $activite->description = $request->description;
                $activite->datedebut = $request->datedebut;
                $activite->datefin = $request->datefin;
                $activite->validation_finance = $request->validation_finance;
                $activite->validation_raf = $request->validation_raf;
                $activite->validation_supperieur = $request->validation_supperieur;
                $activite->statut1 = $request->statut1;
                $activite->statut2 = $request->statut2;
                $activite->statut3 = $request->statut3;
                $activite->statut4 = $request->statut4;
                $activite->statut5 = $request->statut5;
                $activite->statut6 = $request->statut6;
                $activite->statutfin = $request->statutfin;
                $activite->enregistrer = $request->enregistrer;

                $activite->save();

                // Enregistrement dans la table attributionactivite pour le control lors d'un nouveau enregistrement
                $attribution = new AttributionActivite();
                $attribution->nom_employe = $request->input('employe_id'); // Remplacez par le champ correct de la table Autre
                $attribution->code_activite = $request->input('code'); // Remplacez par le champ correct de la table Autre
                $attribution->save();

                // Valider et exécuter la transaction si tout s'est bien passé
                DB::commit();

                // Redirection avec un message de succès (vous pouvez modifier la redirection selon vos besoins)
                return redirect()->route('activites.create')->with('success', 'Activité enregistrée avec succès.');
            } catch (\Exception $e) {
                // En cas d'erreur, annuler la transaction et retourner à la page précédente avec un message d'erreur
                DB::rollback();
                return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement des données.');
            }
        }
        else
        {
            return redirect()->route('activites.create')->with('error', "l'employé possède deux activités dont les rapports sont pas à jour");

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
        $activite = Activite::find($id);
        return view('activites.show', compact('activite'));
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
        $activite = Activite::find($id);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        return view('activites.edit', compact('activite', 'listeprojets', 'listeemployes'));
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
            'pdf_besoin' => 'nullable|mimes:pdf|max:4096',
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
        $activite = Activite::find($id);
        $activite->projet_id = $request->input('projet_id');
        $activite->employe_id = $request->input('employe_id');
        $activite->code = $request->input('code');
        $activite->nom = $request->input('nom');
        // Traitement du nouveau fichier PDF
        if ($request->hasFile('nouveau_pdf1')) {
            // Supprimer l'ancien fichier PDF s'il existe
            Storage::delete($activite->pdf_tdr);

            // Enregistrer le nouveau fichier PDF
            $pdfPath = $request->file('nouveau_pdf1')->store('pdfs', 'public');
            $activite->update(['pdf_tdr' => $pdfPath]);
        }
        // Traitement du nouveau fichier PDF
        if ($request->hasFile('nouveau_pdf2')) {
            // Supprimer l'ancien fichier PDF s'il existe
            Storage::delete($activite->pdf_besoin);

            // Enregistrer le nouveau fichier PDF
            $pdfPath = $request->file('nouveau_pdf2')->store('pdfs', 'public');
            $activite->update(['pdf_besoin' => $pdfPath]);
        }
        $activite->objectif = $request->input('objectif');
        $activite->budget = $request->input('budget');
        $activite->localite = $request->input('localite');
        $activite->description = $request->input('description');
        $activite->datedebut = $request->input('datedebut');
        $activite->datefin = $request->input('datefin');
        $activite->modifier = $request->input('modifier');
        $activite->save();

        return redirect()->route('activites.index')
            ->with('success', 'Activité modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activite = Activite::find($id);
        $activite->delete();

        return redirect()->route('activites.index')
            ->with('success', 'Activité supprimée avec succès');
    }
}
