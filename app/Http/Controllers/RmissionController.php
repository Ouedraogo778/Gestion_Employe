<?php

namespace App\Http\Controllers;

use App\Models\AttributionMission;
use App\Models\Employe;
use App\Models\Mission;
use App\Models\Projet;
use App\Models\RetardRapportmission;
use App\Models\Rmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:rmission-liste|rmission-ajouter|rmission-modifier|rmission-supprimer', ['only' => ['index', 'show']]);
        $this->middleware('permission:rmission-ajouter', ['only' => ['create', 'store']]);
        $this->middleware('permission:rmission-modifier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rmission-supprimer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rmissions = Rmission::latest()->paginate(25);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        $listemissions = Mission::all();
        return view('rmissions.index', compact('rmissions','listeprojets','listeemployes','listemissions'))
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
        $listemissions = Mission::leftJoin('rmissions', function ($join) {
            $join->on('missions.code', '=', 'rmissions.mission_id');
        })
            ->whereNull('rmissions.mission_id')
            ->where('missions.statut3', 1)
            ->get();
        

        return view('rmissions.create',compact('listeprojets','listeemployes','listemissions'));
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
        'mission_id',
        'pdf_file1'=> 'nullable|mimes:pdf,docx,xls,xlsx|max:4096',
        'pdf_file2'=> 'nullable|mimes:pdf,docx,xls,xlsx|max:4096',
        'pdf_file3'=> 'nullable|mimes:pdf,docx,xls,xlsx|max:4096',
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

        $rmission = new Rmission();
        $rmission->projet_id = $request->projet_id;
        $rmission->employe_id = $request->employe_id;
        $rmission->mission_id= $request->mission_id;
        
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
                $rmission->pdf_rmission = $filePath;
                
                // ... (le reste du code)
            } else {
                // Type de fichier non pris en charge
                return redirect()->back()->with('error', 'Type de fichier non pris en charge. Veuillez télécharger un fichier PDF, Word ou Excel.');
            }
        }

        //pdf_licence
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
                $rmission->pdf_listepresence = $filePath;
                
                // ... (le reste du code)
            } else {
                // Type de fichier non pris en charge
                return redirect()->back()->with('error', 'Type de fichier non pris en charge. Veuillez télécharger un fichier PDF, Word ou Excel.');
            }
        }

        //rapport financier

        if ($request->hasFile('pdf_file3')) {
            $uploadedFile = $request->file('pdf_file3');
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
                $rmission->pdf_rfinancier = $filePath;
                
                // ... (le reste du code)
            } else {
                // Type de fichier non pris en charge
                return redirect()->back()->with('error', 'Type de fichier non pris en charge. Veuillez télécharger un fichier PDF, Word ou Excel.');
            }
        }
        
        
    
        $rmission->datechargement= $request->datechargement;
        $rmission->datechargement = Carbon::now()->format('d-m-Y');
        $rmission->validation_finance= $request->validation_finance;
        $rmission->validation_raf= $request->validation_raf;
        $rmission->validation_supperieur= $request->validation_supperieur;
        $rmission->statut1= $request->statut1;
        $rmission->statut2= $request->statut2;
        $rmission->statut3= $request->statut3;
        $rmission->statut4= $request->statut4;
        $rmission->statut5= $request->statut5;
        $rmission->statut6= $request->statut6;
        $rmission->enregistrer= $request->enregistrer;
        $rmission->save();

        $recu = $request->input('mission_id');
        AttributionMission::where('code_mission',$recu)->delete();
        RetardRapportmission::where('mission_id',$recu)->delete();


        return redirect()->route('rmissions.create')
            ->with('success', 'Rapport de mission enregistré avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rmission = Rmission::find($id);
        return view('rmissions.show', compact('rmission'));
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
        $rmission = Rmission::find($id);
        $listeprojets = Projet::all(); //affichage de la liste des projets
        $listeemployes = Employe::all();
        $listemissions = Mission::all();
        return view('rmissions.edit', compact('rmission','listeprojets','listeemployes','listemissions'));
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
        'pdf_file1'=> 'nullable|mimes:pdf|max:4096',
        'pdf_file2'=> 'nullable|mimes:pdf|max:4096',
        'pdf_file3'=> 'nullable|mimes:pdf|max:4096',
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
        $rmission = Rmission::find($id);
        $rmission->projet_id = $request->input('projet_id');
        $rmission->employe_id = $request->input('employe_id');
        $rmission->mission_id= $request->input('mission_id');
        $rmission->pdf_rmission = $request->input('pdf_rmission');
        $rmission->pdf_rfinancier = $request->input('pdf_rfinancier');
        $rmission->pdf_listepresence = $request->input('pdf_listepresence');
        $rmission->datechargement = $request->input('datechargement');
         // Traitement du nouveau fichier PDF
         if ($request->hasFile('nouveau_pdf1')) {
            // Supprimer l'ancien fichier s'il existe
            if ($rmission->pdf_rmission) {
                Storage::delete($rmission->pdf_rmission);
            }
        
            // Enregistrer le nouveau fichier
            $pdfPath = $request->file('nouveau_pdf1')->store('pdfs', 'public');
            $rmission->update(['pdf_rmission' => $pdfPath]);
        }

        //liste de presence
        if ($request->hasFile('nouveau_pdf1')) {
            // Supprimer l'ancien fichier s'il existe
            if ($rmission->pdf_listepresence) {
                Storage::delete($rmission->pdf_listepresence);
            }
        
            // Enregistrer le nouveau fichier
            $pdfPath = $request->file('nouveau_pdf1')->store('pdfs', 'public');
            $rmission->update(['pdf_listepresence' => $pdfPath]);
        }

        //rapport financier
        if ($request->hasFile('nouveau_pdf1')) {
            // Supprimer l'ancien fichier s'il existe
            if ($rmission->pdf_rfinancier) {
                Storage::delete($rmission->pdf_rfinancier);
            }
        
            // Enregistrer le nouveau fichier
            $pdfPath = $request->file('nouveau_pdf1')->store('pdfs', 'public');
            $rmission->update(['pdf_rfinancier' => $pdfPath]);
        }
        
     
        $rmission->datechargement = $request->input('datechargement');
        $rmission->modifier = $request->input('modifier');
        $rmission->save();

        return redirect()->route('rmissions.index')
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
        $rmission = Rmission::find($id);
        $rmission->delete();

        return redirect()->route('rmissions.index')
            ->with('success', ' Rapport mission supprimée avec succès');
    }
}
