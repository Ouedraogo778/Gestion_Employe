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
                <a class="mote btn" href="{{ route('employes.index') }}">Liste des informations des
                    employés</a>
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
                                <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Modification des informations d'un employé</h3>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('employes.update', $employe->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        
                                            <div class="mb-3 ">
                                                <label class="form-label">Nom & Prenom<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="nom_prenom" value="{{ $employe->nom_prenom }}" required>
                                            </div>
                                            
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Date de naissance<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="datenaissance" value="{{ $employe->datenaissance }}" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="exampleInputEmail1" class="form-label">Genre<span class="login-danger">*</span></label>
                                                <select name="genre" class="form-control select" id="" required>
                                                    @if($employe->genre == 'M')
                                                    <option value="M">Masculin</option>
                                                    @else
                                                    <option value="F">Feminin</option>
                                                    @endif
                                                    <option value="F">Feminin</option>
                                                    <option value="M">Masculin</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Télephone<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="telephone" value="{{ $employe->telephone }}" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email<span class="login-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" value="{{ $employe->email }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Poste<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="poste" value="{{ $employe->poste }}" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Date d'embauche<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="dateembauche" value="{{ $employe->dateembauche }}" required>
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