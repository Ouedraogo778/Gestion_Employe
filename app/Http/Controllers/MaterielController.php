<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:materiel-liste|materiel-ajouter|materiel-modifier|materiel-supprimer', ['only' => ['index', 'show']]);
        $this->middleware('permission:materiel-ajouter', ['only' => ['create', 'store']]);
        $this->middleware('permission:materiel-modifier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:materiel-supprimer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiels = Materiel::latest()->paginate(25);
        // $listeprojets = Projet::all(); //affichage de la liste des projets
        return view('materiels.index', compact('materiels'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('materiels.create');
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

            'typemateriel',
            'nom',
            'codemateriel',
            'datecreation',
            'enregistrer',
            
        ]);

        $materiel = new Materiel();
        $materiel->typemateriel = $request->typemateriel;
        $materiel->nom = $request->nom;
        $materiel->codemateriel= $request->codemateriel;
        $materiel->datecreation= $request->datecreation;  
        $materiel->enregistrer= $request->enregistrer;
        $materiel->save();
        

        return redirect()->route('materiels.create')
            ->with('success', 'Matériel enregistré avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materiel = Materiel::find($id);
        return view('materiels.show', compact('materiel'));
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
        $materiel = Materiel::find($id);
        return view('materiels.edit', compact('materiel'));
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

            'typemateriel',
            'nom',
            'codemateriel',
            'datecreation',
            'modifier',
        ]);
        $materiel = Materiel::find($id);
        $materiel->typemateriel = $request->input('typemateriel');
        $materiel->nom = $request->input('nom');
        $materiel->codemateriel = $request->input('codemateriel');
        $materiel->datecreation = $request->input('datecreation');
        $materiel->modifier = $request->input('modifier');
        $materiel->save();

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materiel = Materiel::find($id);
        $materiel->delete();

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel supprimé avec succès');
    }
}
