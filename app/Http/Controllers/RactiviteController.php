<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\AttributionActivite;
use App\Models\ChampsSupplementaire;
use App\Models\ChampSupplementaire;
use App\Models\Employe;
use App\Models\Projet;
use App\Models\Ractivite;
use App\Models\RetardRapport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RactiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:ractivite-liste|ractivite-ajouter|ractivite-modifier|ractivite-supprimer', ['only' => ['index', 'show']]);
        $this->middleware('permission:ractivite-ajouter', ['only' => ['create', 'store']]);
        $this->middleware('permission:ractivite-modifier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ractivite-supprimer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ractivites = Ractivite::with('champsSupplementaires')->latest()->paginate(25);
    $listeprojets = Projet::all(); //affichage de la liste des projets
    $listeemployes = Employe::all();
    $listeactivites = Activite::all();
    return view('ractivites.index', compact('ractivites', 'listeprojets', 'listeemployes', 'listeactivites'))
        ->with('i', (request()->input('page', 1) - 1) * 25);
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        // $listeactivites = Activite::where('statut3', 1)->get();
        $listeactivites = Activite::leftJoin('ractivites', function ($join) {
            $join->on('activites.code', '=', 'ractivites.activite_id');
        })
            ->whereNull('ractivites.activite_id')
            ->where('activites.statut3', 1)
            ->get();

        return view('ractivites.create', compact('listeprojets', 'listeemployes', 'listeactivites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([

            'projet_id',
            'employe_id',
            'activite_id',
            'pdf_file1' => 'nullable|mimes:pdf,docx,xls,xlsx|max:4096',
            'piece1',
            'montant1',
            'piece2',
            'montant2',
            'piece3',
            'montant3',
            'sommeTotale',
            'libelle_supplementaire.*' => 'nullable', // Les champs supplémentaires sont facultatifs
            'montant_supplementaire.*' => 'nullable',
            'datechargement',
            'validation_finance',
            'validation_raf',
            'validation_supperieur',
            'statut1',
            'statut2',
            'statut3',
            'statut4',
            'statut5',
            'statut6',
            'enregistrer',

        ]);

        // $montant1=$request->input('montant1');
        // $montant2=$request->input('montant2');
        // $montant3=$request->input('montant3');



        // // Calculer la somme des montants principaux
        // $sommeMontantsPrincipaux = $request->montant;

        // // Calculer la somme des montants supplémentaires
        // $sommeMontantsSupplementaires = array_sum($request->montant_supplementaire);

        // Calculer la somme totale
        //$sommeTotale = $montant1+$montant2+$montant3;


        $ractivite = new Ractivite();
        $ractivite->projet_id = $request->projet_id;
        $ractivite->employe_id = $request->employe_id;
        $ractivite->activite_id = $request->activite_id;





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
                $ractivite->pdf_ractivite = $filePath;

                // ... (le reste du code)
            } else {
                // Type de fichier non pris en charge
                return redirect()->back()->with('error', 'Type de fichier non pris en charge. Veuillez télécharger un fichier PDF, Word ou Excel.');
            }
        }

        $ractivite->piece1 = $request->piece1;
        $ractivite->montant1 = $request->montant1;
        $ractivite->piece2 = $request->piece2;
        $ractivite->montant2 = $request->montant2;
        $ractivite->piece3 = $request->piece3;
        $ractivite->montant3 = $request->montant3;
        $ractivite->sommeTotale = $request->sommeTotale;
        $ractivite->datechargement = $request->datechargement;
        $ractivite->datechargement = Carbon::now()->format('d-m-Y');
        $ractivite->validation_finance = $request->validation_finance;
        $ractivite->validation_raf = $request->validation_raf;
        $ractivite->validation_supperieur = $request->validation_supperieur;
        $ractivite->statut1 = $request->statut1;
        $ractivite->statut2 = $request->statut2;
        $ractivite->statut3 = $request->statut3;
        $ractivite->statut4 = $request->statut4;
        $ractivite->statut5 = $request->statut5;
        $ractivite->statut6 = $request->statut6;
        $ractivite->enregistrer = $request->enregistrer;
        //$ractivite->somme_totale = $sommeTotale; // Enregistrer la somme totale
        $ractivite->save();


        //recupere l'identifiant de l'activite et le supprime lorsque le rapport est chargé
        $recu = $request->input('activite_id');
        $recup = $request->input('activite_id');
        AttributionActivite::where('code_activite', $recu)->delete();
        RetardRapport::where('activite_id', $recup)->delete();


        // Enregistrer les champs supplémentaires
        foreach ($request->input('libelle_supplementaire', []) as $key => $libelle) {
            if (!empty($libelle) && isset($request->montant_supplementaire[$key])) {
                $montant = $request->montant_supplementaire[$key];
                // Créer un nouvel enregistrement pour chaque champ supplémentaire en utilisant le modèle ChampSupplementaire
                ChampsSupplementaire::create(['libelle' => $libelle, 'montant' => $montant, 'ractivite_id' => $ractivite->id]);
            }
        }


        return redirect()->route('ractivites.create')
            ->with('success', 'Rapport activité enregistré avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ractivite = Ractivite::find($id);
        return view('ractivites.show', compact('ractivite'));
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
        $ractivite = Ractivite::find($id);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        $listeactivites = Activite::all();
        return view('ractivites.edit', compact('ractivite', 'listeprojets', 'listeemployes', 'listeactivites'));
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
            'activite_id',
            'pdf_file1' => 'nullable|mimes:pdf|max:4096',
            'montant1',
            'piece2',
            'montant2',
            'piece3',
            'montant3',
            'sommeTotale',
            'libelle_supplementaire.*' => 'nullable', // Les champs supplémentaires sont facultatifs
            'montant_supplementaire.*' => 'nullable',
            'datechargement',
            'validation_finance',
            'validation_raf',
            'validation_supperieur',
            'statut1',
            'statut2',
            'statut3',
            'statut4',
            'statut5',
            'statut6',
            'modifier',
        ]);
        $ractivite = Ractivite::find($id);
        $ractivite->projet_id = $request->input('projet_id');
        $ractivite->employe_id = $request->input('employe_id');
        $ractivite->activite_id = $request->input('activite_id');
        $ractivite->pdf_ractivite = $request->input('pdf_ractivite');
        $ractivite->piece1 = $request->input('piece1');
        $ractivite->montant1 = $request->input('montant1');
        $ractivite->piece2 = $request->input('piece2');
        $ractivite->montant2 = $request->input('montant2');
        $ractivite->piece3 = $request->input('piece3');
        $ractivite->montant3 = $request->input('montant3');
        $ractivite->sommeTotale = $request->input('sommeTotale');
        $ractivite->datechargement = $request->input('datechargement');
        // Traitement du nouveau fichier PDF
        if ($request->hasFile('nouveau_pdf1')) {
            // Supprimer l'ancien fichier s'il existe
            if ($ractivite->pdf_ractivite) {
                Storage::delete($ractivite->pdf_ractivite);
            }

            // Enregistrer le nouveau fichier
            $pdfPath = $request->file('nouveau_pdf1')->store('pdfs', 'public');
            $ractivite->update(['pdf_ractivite' => $pdfPath]);
        }

 
// foreach ($request->input('libelle_supplementaire', []) as $key => $libelle) {
//     if (!empty($libelle) && isset($request->montant_supplementaire[$key])) {
//         $montant = $request->montant_supplementaire[$key];

//         ChampsSupplementaire::updateOrCreate(
//             ['ractivite_id' => $ractivite->id, 'id' => $key], // Conditions de recherche
//             ['libelle' => $libelle, 'montant' => $montant] // Valeurs à mettre à jour ou à créer
//         );
//     }
// }

// Mettre à jour les champs supplémentaires existants
foreach ($ractivite->champsSupplementaires as $champSupplementaire) {
    // Trouver l'index correspondant du champ supplémentaire dans les données de la requête
    $index = array_search($champSupplementaire->id, $request->input('champs_supplementaires_ids', []));

    // Si le champ supplémentaire existe toujours dans la requête, le mettre à jour
    if ($index !== false) {
        $champSupplementaire->libelle = $request->input('libelle_supplementaire')[$index];
        $champSupplementaire->montant = $request->input('montant_supplementaire')[$index];
        $champSupplementaire->save();
    } else {
        // Si le champ supplémentaire n'existe pas dans la requête, le supprimer
        $champSupplementaire->delete();
    }
}

// Ajouter de nouveaux champs supplémentaires
foreach ($request->input('libelle_supplementaire', []) as $index => $libelle) {
    // Si le libellé n'est pas vide, ajouter un nouveau champ supplémentaire
    if (!empty($libelle)) {
        $montant = $request->input('montant_supplementaire')[$index];
        $champSupplementaire = new ChampsSupplementaire();
        $champSupplementaire->libelle = $libelle;
        $champSupplementaire->montant = $montant;
        $ractivite->champsSupplementaires()->save($champSupplementaire);
    }
}

        $ractivite->datechargement = $request->input('datechargement');
        $ractivite->modifier = $request->input('modifier');
        $ractivite->save();

      
 
        return redirect()->route('ractivites.index')
            ->with('success', 'Rapport modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ractivite = Ractivite::find($id);
        $ractivite->delete();

        return redirect()->route('ractivites.index')
            ->with('success', ' Rapport Activité supprimée avec succès');
    }
}
