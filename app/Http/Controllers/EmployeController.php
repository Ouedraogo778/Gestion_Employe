<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:employe-liste|employe-ajouter|employe-modifier|employe-supprimer', ['only' => ['index', 'show']]);
        $this->middleware('permission:employe-ajouter', ['only' => ['create', 'store']]);
        $this->middleware('permission:employe-modifier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employe-supprimer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = Employe::latest()->paginate(25);
        // $listeprojets = Projet::all(); //affichage de la liste des projets
        return view('employes.index', compact('employes'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('employes.create');
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

            'nom_prenom',
            'datenaissance',
            'genre',
            'telephone',
            'email'=> "required|email",
            'poste',
            'dateembauche',
            'enregistrer',
        ]);

        $employe = new Employe();
        $employe->nom_prenom = $request->nom_prenom;
        $employe->datenaissance= $request->datenaissance;
        $employe->genre= $request->genre;
        $employe->telephone= $request->telephone;
        $employe->email= $request->email;
        $employe->poste= $request->poste;
        $employe->dateembauche= $request->dateembauche;
        $employe->enregistrer= $request->enregistrer;

        $employe->save();
        

        return redirect()->route('employes.create')
            ->with('success', 'Employe enregistrer avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = Employe::find($id);
        return view('employes.show', compact('employe'));
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
        $employe = Employe::find($id);
        return view('employes.edit', compact('employe'));
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

            'nom_prenom',
            'datenaissance',
            'genre',
            'telephone',
            'email',
            'poste',
            'dateembauche',
            'modifier',
        ]);
        $employe = Employe::find($id);
        $employe->nom_prenom = $request->input('nom_prenom');
        $employe->datenaissance = $request->input('datenaissance');
        $employe->genre = $request->input('genre');
        $employe->telephone = $request->input('telephone');
        $employe->email = $request->input('email');
        $employe->poste = $request->input('poste');
        $employe->dateembauche = $request->input('dateembauche');
        $employe->modifier = $request->input('modifier');
        $employe->save();

        return redirect()->route('employes.index')
            ->with('success', 'Employe modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FicheProjet  $ficheprojet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employe = Employe::find($id);
        $employe->delete();

        return redirect()->route('employes.index')
            ->with('success', 'Employé supprimé avec succès');
    }
}
