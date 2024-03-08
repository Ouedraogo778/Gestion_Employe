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
            @can('employe-liste')
            <div class="pull-right" style="text-align: center;">
                <a class="mote btn" href="{{ route('projets.index') }}">-- Liste des projets
                 --</a>
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
                            <div class="card-header text-center" style="background-color: #BBD2E1;">
                                <h3>Modification d'un projet</h3>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('projets.update', $projet->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Code du projet</label>
                                                <input type="text" class="form-control" name="codeprojet" value="{{ $projet->codeprojet }}" require>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="nom" class="form-label">Nom</label>
                                                <input type="text" class="form-control" name="nom" value="{{ $projet->nom }}" require>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Date de début</label>
                                                <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="datedebut" value="{{ $projet->datedebut }}" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Date de fin</label>
                                                <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="datefin" value="{{ $projet->datefin }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="mb-3 col-md-6">
                                                <label class="form-label">Date de création</label>
                                                <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="datecreation" value="{{ $projet->datecreation }}" required>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="mb-3 col-md-6" style="display: none;">
                                            <label class="form-label">User</label>
                                            <input type="text" class="form-control" name="modifier" value="{{ Auth::user()->name }}" readonly>
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