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
                color: white;
                background-color:blue;
               
                transition: all ease-in-out 0.3s;
                font-size: 18px;
                border-radius: 12px;
            }

            

           
        </style>

       

        <br>


        <div class="col-lg-12 margin-tb">
            @can('mission-liste')
            <div class="pull-right" style="text-align: center;">
                <a class="mote btn" href="{{ route('missions.index') }}">Liste  des missions
                    </a>
            </div>
            @endcan

        </div>
        

        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">

                    <!--  -------------   debut  message de retour  ------------------------------- -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Erreur!</strong> <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!--  -------------   fin  message de retour  ------------------------------- -->
                    <!--  -------------   debut  message de retour  ------------------------------- -->
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <!--  -------------   fin  message de retour  ------------------------------- -->

                    <!-------------------    debut du formulaire pour les De fiche suivi des projets  -------------------- -->

                    <!-------------------    fin du formulaire pour les De fiche suivi des projets  -------------------- -->
                    <div class="container mt-5 d-flex justify-content-center">
                        <div class="card card-width w-75">
                                <div class="card-header text-center" style="background-color:blue;">
                                    <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Ajouter une mission</h3>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('missions.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Code du projet<span class="login-danger">*</span></label>
                                                    <select name="projet_id" class="form-control select" id="" required>
                                                        <option selected disabled>Choisir code du projet</option>
                                                        @foreach($listeprojets as $listeprojet)
                                                        <option value="{{$listeprojet->codeprojet}}">{{$listeprojet->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Employé<span class="login-danger">*</span></label>
                                                    <select name="employe_id" class="form-control select" id="" required>
                                                        <option selected disabled>Choisir l'employé</option>
                                                        @foreach($listeemployes as $listeemploye)
                                                        <option value="{{$listeemploye->nom_prenom}}">{{$listeemploye->nom_prenom}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Code de la mission<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="code" placeholder="code" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" name="nom" placeholder="nom" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 ">
                                                    <label class="form-label">Odre de mission<span class="login-danger">*</span></label>
                                                    <input type="file" name="pdf_file1" class="form-control" accept=".pdf, .docx, .xls, .xlsx">
                                                </div>
                                                <!-- <div class="mb-3 col-md-6">
                                                    <label class="form-label">Expression de besoin</label>
                                                    <input type="file" name="pdf_file2" class="form-control-file" accept=".pdf">
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Objectif<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="objectif" placeholder="objectif" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Budget<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="budget" placeholder="budget" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Localité<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="localite" placeholder="localite" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-class" id="" cols="30" rows="10"></textarea>
                                                   
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="mb-3 col-md-6">
                                                    <label class="form-label">Date de debut<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="datedebut" placeholder="DD-MM-YYYY" value="{{ old('date_of_birth') }}" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Date de fin<span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="datefin" placeholder="DD-MM-YYYY" value="{{ old('date_of_birth') }}" required>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 col-md-6" style="display: none;">
                                                <label class="form-label">User</label>
                                                <input type="text" class="form-control" name="statut1" value="0" readonly>
                                                <input type="text" class="form-control" name="statut2" value="0" readonly>
                                                <input type="text" class="form-control" name="statut3" value="0" readonly>
                                                <input type="text" class="form-control" name="statut4" value="0" readonly>
                                                <input type="text" class="form-control" name="statut5" value="0" readonly>
                                                <input type="text" class="form-control" name="statut6" value="0" readonly>
                                                <input type="text" class="form-control" name="statutfin" value="0" readonly>
                                                <input type="text" class="form-control" name="validation_finance" value="En attente" readonly>
                                                <input type="text" class="form-control" name="validation_raf" value="En attente" readonly>
                                                <input type="text" class="form-control" name="validation_supperieur" value="En attente" readonly>

                                                <input type="text" class="form-control" name="enregistrer" value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <!-- <div class="mb-3" style="text-align: center;">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                       </div> -->

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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
        <script type="text/javascript">
            var form = document.getElementById("needs-validation");
            form.addEventListener('submit', valider);

            function valider(e) {
                if (form.checkValidity() == false) {
                    e.preventDefault();
                }
                from.classList.add('was-validated');
            }
        </script>

        @endsection