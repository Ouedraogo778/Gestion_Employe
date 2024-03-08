@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <style>
                .titre {
                    text-align: center;
                    background-color: rgb(80, 98, 216);
                    border-radius: 10px;
                    border: 1px solid black;

                }

                .titre h2 {
                    color: rgb(255, 255, 255);
                    padding: 8px;
                    font-family: Arial, Helvetica, sans-serif;

                }

                .mote {
                    color:white;
                    background-color:blue;

                    transition: all ease-in-out 0.3s;
                    font-size: 18px;
                    border-radius: 12px;
                }
            </style>

            

            <br>


            <div class="col-lg-12 margin-tb">
                @can('activite-liste')
                    <div class="pull-right" style="text-align: center;">
                        <a class="mote btn" href="{{ route('activites.index') }}">Liste des activités
                            </a>
                    </div>
                @endcan

            </div>
            <br>


            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">

                        <!--  -------------   debut  message de retour  ------------------------------- -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Erreur!</strong> Veuillez remplir tous les champs S'il vous plait.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!--  -------------   fin  message de retour  ------------------------------- -->
                        <div class="container mt-5 d-flex justify-content-center">
                            <div class="card card-width w-75">
                                <div class="card-header text-center" style="background-color:blue;">
                                    <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Modification des informations d'une activité</h3>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('activites.update', $activite->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Code du projet <span class="login-danger">*</span></label>
                                                        <select name="projet_id" class="form-control select" id="" required>
                                                            @foreach ($listeprojets as $listeprojet)
                                                            @if($listeprojet->codeprojet == $activite->projet_id)
                                                            <option value="{{ $listeprojet->codeprojet }}">{{ $listeprojet->nom }}</option>
                                                            @endif
                                                            @endforeach

                                                            @foreach ($listeprojets as $listeprojet)
                                                                <option value="{{ $listeprojet->codeprojet }}">
                                                                    {{ $listeprojet->nom }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Employé<span class="login-danger">*</span></label>
                                                        <select name="employe_id" class="form-control select"
                                                            id="" required>
                                                          
                                                            <option value="{{ $activite->employe_id }}">{{ $activite->employe_id }}</option>

                                                            @foreach ($listeemployes as $listeemploye)
                                                                <option value="{{ $listeemploye->nom_prenom }}">
                                                                    {{ $listeemploye->nom_prenom}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Code de l'activite<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="code"
                                                        value="{{ $activite->code }}" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="nom" class="form-label">Nom de l'activité</label>
                                                    <input type="text" class="form-control" name="nom"
                                                        value="{{ $activite->nom }}" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <div class="form-group local-forms">

                                                        <label  class="form-label">PDF TDR
                                                            actuel</label>
                                                        @if ($activite->pdf_tdr)
                                                            <a href="{{ asset('storage/' . $activite->pdf_tdr) }}"
                                                                target="_blank">
                                                                Voir le PDF actuel
                                                            </a>
                                                        @else
                                                            Aucun fichier PDF associé.
                                                        @endif
                                                        <br><br><br>

                                                        <label class="form-label">Nouveau
                                                            PDF_TDR<span class="login-danger">*</span></label>
                                                        <input class=" form-control" type="file" name="nouveau_pdf1" accept="*/*">
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <div class="form-group local-forms">

                                                        <label class="form-label">PDF besoin
                                                            actuel</label>
                                                        @if ($activite->pdf_besoin)
                                                            <a href="{{ asset('storage/' . $activite->pdf_besoin) }}"
                                                                target="_blank">
                                                                Voir le PDF actuel
                                                            </a>
                                                        @else
                                                            Aucun fichier PDF associé.
                                                        @endif
                                                        <br><br><br>

                                                        <label  class="form-label">Nouveau
                                                            PDF_besion <span class="login-danger">*</span></label>
                                                        <input  class=" form-control" type="file" name="nouveau_pdf2" accept="*/*">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Objectif<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="objectif"
                                                        value="{{ $activite->objectif }}" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="nom" class="form-label">Budget<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="budget"
                                                        value="{{ $activite->budget }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Localite<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="localite"
                                                        value="{{ $activite->localite }}" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Description Matérièl</label>
                                                    <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ $activite->description }}</textarea>
                                                    <!-- <input type="text" class="form-control" name="description"
                                                        value="" require> -->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Date de debut<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror"
                                                        name="datedebut" value="{{ $activite->datedebut }}" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Date de fin<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror"
                                                        name="datefin" value="{{ $activite->datefin }}" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6" style="display: none;">
                                                <label class="form-label">User</label>
                                                <input type="text" class="form-control" name="modifier"
                                                    value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <!-- <div class="mb-3" style="text-align: center;">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                               </div> -->

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
