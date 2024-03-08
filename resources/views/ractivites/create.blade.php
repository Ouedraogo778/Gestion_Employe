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
                <a class="mote btn" href="{{ route('ractivites.index') }}"> Liste des rapports d'activité
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
                    <!--  -------------   fin  message de retour  ------------------------------- -->

                    <!-------------------    debut du formulaire pour les De fiche suivi des projets  -------------------- -->

                    <!-------------------    fin du formulaire pour les De fiche suivi des projets  -------------------- -->
                    <div class="container mt-5 d-flex justify-content-center">
                        <div class="card card-width w-75">
                            <div class="card-header text-center" style="background-color: blue;">
                                <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Ajouter un rapport d'activite</h3>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('ractivites.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Code activité<span class="login-danger">*</span></label>
                                                <select name="activite_id" class="form-control select" id="activite_id" required>
                                                    <option selected disabled>Choisir l'activité</option>
                                                    @foreach($listeactivites as $listeactivite)
                                                    <option value="{{$listeactivite->code}}">
                                                        {{$listeactivite->code}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Employé<span class="login-danger">*</span></label>
                                                <input type="text" name="employe_id" id="nom_employe" class="form-control" placeholder="Nom de l'employé" readonly required>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Code du projet<span class="login-danger">*</span></label>
                                                <input type="text" name="projet_id" id="code_projet" class="form-control" placeholder="code projet" readonly required>


                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">PDF du Rapport<span class="login-danger">*</span></label>
                                                <input type="file" name="pdf_file1" class="form-control" accept=".pdf, .docx, .xls, .xlsx" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Pièce justificative 1</label>
                                                <input type="text" name="piece1" class="form-control" placeholder=" piece justificative">


                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="montant1" class="form-label">Montant pièce justificative 1</label>
                                                <input type="number" id="montant1" name="montant1"  oninput="calculerSomme()" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Pièce justificative 2</label>
                                                <input type="text" name="piece2" class="form-control"  placeholder=" piece justificative">


                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="montant2" class="form-label">Montant pièce justificative 2</label>
                                                <input type="number"  id="montant2" name="montant2" oninput="calculerSomme()" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="montant3" class="form-label">Pièce justificative 3</label>
                                                <input type="text" name="piece3" class="form-control"  placeholder=" piece justificative">


                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Montant pièce justificative 3</label>
                                                <input type="number" id="montant3" name="montant3"  oninput="calculerSomme()" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="row"  id="champs-additionnels">
                                            

                                        </div>
                                        <button type="button" id="ajouter-champ">Ajouter un champ</button>

                                        <div class="mb-3">
                                            <label for="sommeTotal" class="form-label">Total<span class="login-danger">*</span></label>
                                            <input type="text" id="sommeTotale" name="sommeTotale"   class="form-control " required readonly />
                                           
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Date de chargement<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control datetimepicker text-center @error('datecreation') is-invalid @enderror" name="datechargement" placeholder="DD-MM-YYYY" value="{{ old('datecreation', \Carbon\Carbon::now()->format('d-m-Y')) }}" required readonly />
                                            @error('datechargement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6" style="display: none">
                                            <label class="form-label">User</label>
                                            <input type="text" class="form-control" name="statut1" value="0" readonly />
                                            <input type="text" class="form-control" name="statut2" value="0" readonly />
                                            <input type="text" class="form-control" name="statut3" value="0" readonly />
                                            <input type="text" class="form-control" name="statut4" value="0" readonly />
                                            <input type="text" class="form-control" name="statut5" value="0" readonly />
                                            <input type="text" class="form-control" name="statut6" value="0" readonly />
                                            <input type="text" class="form-control" name="validation_finance" value="En attente" readonly />
                                            <input type="text" class="form-control" name="validation_raf" value="En attente" readonly />
                                            <input type="text" class="form-control" name="validation_supperieur" value="En attente" readonly />

                                            <input type="text" class="form-control" name="enregistrer" value="{{ Auth::user()->name }}" readonly />
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
    <!-- le code java scripte -->

    <script>
        $(document).ready(function() {
            // Événement de changement pour le champ de sélection du code d'activité
            $('#activite_id').change(function() {
                // Récupérer la valeur sélectionnée
                var codeActivite = $(this).val();

                // Effectuer une requête AJAX pour obtenir le nom de l'employé et le code du projet associés
                $.ajax({
                    type: 'GET',
                    url: '/getNomEmploye/' + codeActivite, // Remplacez avec votre route et contrôleur appropriés
                    success: function(response) {
                        // Mettre à jour le champ du nom de l'employé avec la réponse
                        $('#nom_employe').val(response.nomEmploye);

                        // Mettre à jour le champ du code du projet avec la réponse
                        $('#code_projet').val(response.codeProjet);
                    }
                });
            });
        });
    </script>

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

    <script>
        document.getElementById("monFormulaire").addEventListener("submit", function(event) {
            var dateFin = new Date(document.getElementById("date_fin").value);
            var dateActuelle = new Date();

            if (dateFin < dateActuelle) {
                document.getElementById("alerteDateFin").textContent = "Attention : La date de fin est dépassée !";
                event.preventDefault(); // Annuler la soumission du formulaire
            } else {
                document.getElementById("alerteDateFin").textContent = "";
            }
        });
    </script>
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
    var montantSupplementaireInputs = document.getElementsByName('montant_supplementaire[]');
    var total = montant1 + montant2 + montant3;

    // Ajouter les montants supplémentaires à la somme totale
    for (var i = 0; i < montantSupplementaireInputs.length; i++) {
        var montantSupplementaire = parseFloat(montantSupplementaireInputs[i].value) || 0;
        total += montantSupplementaire;
    }

    // Afficher le total dans le champ sommeTotale
    document.getElementById('sommeTotale').value = total;
}
</script>


    @endsection