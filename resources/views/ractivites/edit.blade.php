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
                background-color: blue;

                transition: all ease-in-out 0.3s;
                font-size: 18px;
                border-radius: 12px;
            }
        </style>

        <br>


        <div class="col-lg-12 margin-tb">
            @can('ractivite-liste')
            <div class="pull-right" style="text-align: center;">
                <a class="mote btn" href="{{ route('ractivites.index') }}"> Liste des rapports d'activités
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
                                <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Modification d'un rapport d'activité</h3>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('ractivites.update', $ractivite->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Code du projet<span class="login-danger">*</span></label>
                                                    <select name="projet_id" class="form-control select" id="" required>
                                                        @foreach ($listeprojets as $listeprojet)
                                                        @if($listeprojet->codeprojet == $ractivite->projet_id)
                                                        <option value="{{ $listeprojet->codeprojet }}">{{ $listeprojet->nom }}</option>
                                                        @endif
                                                        @endforeach

                                                        @foreach ($listeprojets as $listeprojet)
                                                        <option value="{{ $listeprojet->codeprojet }}">
                                                            {{ $listeprojet->nom }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Employé<span class="login-danger">*</span></label>
                                                    <select name="employe_id" class="form-control select" id="" required>

                                                        <option value="{{ $ractivite->employe_id }}">{{ $ractivite->employe_id }}</option>

                                                        @foreach ($listeemployes as $listeemploye)
                                                        <option value="{{ $listeemploye->nom }}">
                                                            {{ $listeemploye->nom}}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Activite<span class="login-danger">*</span></label>
                                                <select name="activite_id" class="form-control select" id="" required>

                                                    <option value="{{ $ractivite->activite_id }}">{{ $ractivite->activite_id }}</option>

                                                    @foreach ($listeactivites as $listeactivite)
                                                    <option value="{{ $listeactivite->nom }}">
                                                        {{ $listeactivite->nom}}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <div class="form-group local-forms">

                                                    <label class="form-label">PDF rapport de l'activité actuel</label>
                                                    @if ($ractivite->pdf_ractivite)
                                                    <a href="{{ asset('storage/' . $ractivite->pdf_ractivite) }}" target="_blank">
                                                        Voir le PDF actuel
                                                    </a>
                                                    @else
                                                    Aucun fichier PDF associé.
                                                    @endif
                                                    <br>

                                                    <label class="form-label">Nouveau PDF du rapport d'activité<span class="login-danger">*</span></label>
                                                    <input class=" form-control" type="file" name="nouveau_pdf1" accept="*/*">
                                                </div>
                                            </div>


                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="nom" class="form-label">Pièce justificative 1<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="piece1" value="{{ $ractivite->piece1 }}" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="montant1" class="form-label">Montant pièce justificative 1</label>
                                                <input type="number" id="montant1" name="montant1" value="{{ $ractivite->montant1 }}" oninput="calculerSomme()" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="nom" class="form-label">Pièce justificative 2<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="piece2" value="{{ $ractivite->piece2 }}" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="montant1" class="form-label">Montant pièce justificative 2</label>
                                                <input type="number" id="montant2" name="montant2" value="{{ $ractivite->montant2 }}" oninput="calculerSomme()" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="nom" class="form-label">Pièce justificative 3<span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="piece3" value="{{ $ractivite->piece3 }}" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="montant2" class="form-label">Montant pièce justificative 3</label>
                                                <input type="number" id="montant3" name="montant3" value="{{ $ractivite->montant3 }}" oninput="calculerSomme()" class="form-control">
                                            </div>
                                        </div>


                                        @foreach($ractivite->champsSupplementaires as $champSupplementaire)
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Libellé pièce supplémentaire</label>
                                                <input type="text" name="libelle_supplementaire[]" class="form-control" value="{{ $champSupplementaire->libelle }}">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Montant pièce supplémentaire</label>
                                                <input type="number" name="montant_supplementaire[]" class="form-control" value="{{ $champSupplementaire->montant }}">
                                            </div>
                                        </div>
                                        @endforeach


                                        <div class="row" id="champs-additionnels">
                                            <!-- Les champs supplémentaires seront ajoutés ici dynamiquement -->
                                        </div>
                                        <button type="button" id="ajouter-champ">Ajouter un champ supplémentaire</button>

                                        <!-- Champs pour afficher la somme totale -->
                                        <div class="mb-3">
                                            <label for="sommeTotale" class="form-label">Total<span class="login-danger">*</span></label>
                                            <input type="text" id="sommeTotale" name="sommeTotale"  class="form-control" value="{{ $ractivite->sommeTotale }}" readonly />
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Date de chargement<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="datechargement" value="{{ $ractivite->datechargement }}" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Piece1<span class="login-danger">*</span></label>
                                        <input type="text" class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror" name="datechargement" value="{{ $ractivite->datechargement }}" required>
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

<script>
    document.getElementById('ajouter-champ').addEventListener('click', function() {
        var divChamps = document.getElementById('champs-additionnels');

        // Création de l'élément label pour le libellé supplémentaire
        var label = document.createElement('label');
        label.textContent = 'Pièce  supplémentaire:';
        label.setAttribute('for', 'libelle_supplementaire');
        label.classList.add('form-label'); // Ajout de la classe form-label

        // Création de l'input pour le libellé supplémentaire
        var labelInput = document.createElement('input');
        labelInput.type = 'text';
        labelInput.name = 'libelle_supplementaire[]';
        labelInput.placeholder = 'Libellé pièce supplémentaire';
        labelInput.classList.add('form-control');

        // Création de l'élément label pour le montant supplémentaire
        var montantLabel = document.createElement('label');
        montantLabel.textContent = 'Montant pièce supplémentaire:';
        montantLabel.setAttribute('for', 'montant_supplementaire');
        montantLabel.classList.add('form-label'); // Ajout de la classe form-label

        // Création de l'input pour le montant supplémentaire
        var amountInput = document.createElement('input');
        amountInput.type = 'text';
        amountInput.name = 'montant_supplementaire[]';
        amountInput.placeholder = 'Montant pièce supplémentaire';
        amountInput.classList.add('form-control');
        amountInput.addEventListener('input', calculerSomme); // Ajout de l'écouteur d'événement

        // Ajout des éléments créés à la div
        divChamps.appendChild(label);
        divChamps.appendChild(labelInput);
        divChamps.appendChild(montantLabel);
        divChamps.appendChild(amountInput);

        // Recalculer la somme totale à chaque ajout de champ supplémentaire
        calculerSomme();
    });

  // Fonction pour calculer la somme totale
  function calculerSomme() {
        var montant1 = parseFloat(document.getElementById('montant1').value) || 0;
        var montant2 = parseFloat(document.getElementById('montant2').value) || 0;
        var montant3 = parseFloat(document.getElementById('montant3').value) || 0;
        var montantSupplementaireInputs = document.querySelectorAll('.form-control[name="montant_supplementaire[]"]');
        var total = montant1 + montant2 + montant3;

        // Ajouter les montants des champs supplémentaires dynamiques à la somme totale
        montantSupplementaireInputs.forEach(function(input) {
            var montantSupplementaire = parseFloat(input.value) || 0;
            total += montantSupplementaire;
        });

        // Ajouter les montants des champs supplémentaires récupérés depuis la base de données
        var montantsChampsSupplementaires = document.querySelectorAll('.form-control[name="montant_supplementaire_db[]"]');
        montantsChampsSupplementaires.forEach(function(input) {
            var montantSupplementaire = parseFloat(input.value) || 0;
            total += montantSupplementaire;
        });

        // Afficher le total dans le champ sommeTotale
        document.getElementById('sommeTotale').value = total;
    }

    // Appeler la fonction calculerSomme() lors du chargement de la page
    window.onload = function() {
        calculerSomme();
    };

    // Appeler la fonction calculerSomme() à chaque fois qu'un champ supplémentaire est modifié
    var montantSupplementaireInputs = document.querySelectorAll('.form-control[name="montant_supplementaire[]"]');
    montantSupplementaireInputs.forEach(function(input) {
        input.addEventListener('input', calculerSomme);
    });

    var montantsChampsSupplementaires = document.querySelectorAll('.form-control[name="montant_supplementaire_db[]"]');
    montantsChampsSupplementaires.forEach(function(input) {
        input.addEventListener('input', calculerSomme);
    });

</script>


@endsection