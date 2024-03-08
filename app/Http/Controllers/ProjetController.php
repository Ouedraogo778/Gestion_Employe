<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projet-liste|projet-ajouter|projet-modifier|projet-supprimer', ['only' => ['index', 'show']]);
        $this->middleware('permission:projet-ajouter', ['only' => ['create', 'store']]);
        $this->middleware('permission:projet-modifier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:projet-supprimer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projets = Projet::latest()->paginate(25);
        // $listeprojets = Projet::all(); //affichage de la liste des projets
        return view('projets.index', compact('projets'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('projets.create');
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

            'codeprojet',
            'nom',
            'datedebut',
            'datefin',
            'datecreation',
            'enregistrer',
            
        ]);

        $projet = new Projet();
        $projet->codeprojet = $request->codeprojet;
        $projet->nom = $request->nom;
        $projet->datedebut= $request->datedebut;
        $projet->datefin= $request->datefin;
        $projet->datecreation = Carbon::now()->format('d-m-Y');   
        $projet->enregistrer= $request->enregistrer;

        $projet->save();
        

        return redirect()->route('projets.create')
            ->with('success', 'Projet enregistré avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projet = Projet::find($id);
        return view('projets.show', compact('projet'));
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
        $projet = Projet::find($id);
        return view('projets.edit', compact('projet'));
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

            'codeprojet',
            'nom',
            'datedebut',
            'datefin',
            'datecreation',
            'modifier',
        ]);
        $projet = Projet::find($id);
        $projet->codeprojet = $request->input('codeprojet');
        $projet->nom = $request->input('nom');
        $projet->datedebut = $request->input('datedebut');
        $projet->datefin = $request->input('datefin');
        $projet->datecreation = $request->input('datecreation');
        $projet->modifier = $request->input('modifier');
        $projet->save();

        return redirect()->route('projets.index')
            ->with('success', 'Projet modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projet = Projet::find($id);
        $projet->delete();

        return redirect()->route('projets.index')
            ->with('success', 'Employé supprimé avec succès');
    }
}
