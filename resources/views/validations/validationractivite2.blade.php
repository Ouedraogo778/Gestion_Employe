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
                font-family: Arial, Helvetica, sans-serif
            }

            .form-control {
                font-size: 20px;
                border: 2px solid rgb(255, 255, 255);
            }
        </style>

        <br>



        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-header text-center" style="background-color:blue;">
                        <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Validation du rapport d'activité</h3>
                    </div>
                    <div class="card-body">

                        <!-- <div class="page-header">
                            <div class="row align-items-center">

                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    @can('ractivite-ajouter')
                                    <a href="{{ route('ractivites.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter une information</a>
                                    @endcan

                                </div>
                            </div>
                        </div> -->
                        <div class="table-responsive">



                            <h3 id="error" class="text-center mt-3"></h3>



                            <!--  -------------   debut  message de retour  ------------------------------- -->
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            <!--  -------------   fin  message de retour  ------------------------------- -->


                            <table id="" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">


                                <thead class="student-thread" id="entete">
                                    <tr>

                                        <th style="font-size: 18px; ">N°</th>
                                        <th style="font-size: 18px; ">Code du projet </th>
                                        <th style="font-size: 18px; ">Employé</th>
                                        <th style="font-size: 18px; ">Code activité</th>
                                        <th style="font-size: 18px; ">Date de chargement</th>
                                        <th style="font-size: 18px; ">PDF rapport</th>
                                        <th style="font-size: 18px; ">Pièce1</th>
                                        <th style="font-size: 18px; ">Piece2</th>
                                        <th style="font-size: 18px; ">Piece3</th>
                                        <th style="font-size: 18px; ">Pièces supplémentaires</th>

                                        <th class="colonne-verte" style="font-size: 18px; background-color:#00FF00">Montant Total</th>


                                        <!-- <th style="font-size: 18px; ">Expression de besoin</th> -->
                                        <th style="font-size: 18px; ">Etat Coordination</th>
                                        <th style="font-size: 18px; ">Motif rejet Coordination</th>
                                        <th style="font-size: 18px; ">Etat raf</th>
                                        <th style="font-size: 18px; ">Motif rejet raf</th>
                                        <th style="font-size: 18px; width: 200px;">Validation RAF</th>


                                        <!-- @can('role-list')
                                        <th style="font-size: 18px; color: black;">Enregistrer par</th>
                                        <th style="font-size: 18px; color: black;">Modifier par</th>
                                        @endcan
                                        <th class="text-end" style="font-size: 18px; color: black;">Action</th> -->
                                    </tr>
                                </thead>


                                <tbody id="Table">

                                    @foreach ($ractivites as $ractivite)
                                    <tr>

                                        <td style="font-size: 16px; color: black;">{{ ++$i }}</td>

                                        <td style="font-size: 16px; color: black; ">{{ $ractivite->projet_id }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $ractivite->employe_id }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $ractivite->activite_id }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">{{ $ractivite->datechargement }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            @if ($ractivite->pdf_ractivite)
                                            <a href="{{ asset('storage/' . $ractivite->pdf_ractivite) }}" target="_blank" class="badge badge-success">
                                                Voir le PDF
                                            </a>
                                            @else
                                            Aucun fichier PDF
                                            @endif
                                        </td>
                                        <td style="font-size: 16px; color: black;">

                                            {{ $ractivite->piece1 }}: {{ $ractivite->montant1 }} FCFA
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $ractivite->piece2 }}: {{ $ractivite->montant2 }} FCFA
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $ractivite->piece3 }}: {{ $ractivite->montant3 }} FCFA
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            <ul>
                                                @foreach($ractivite->champsSupplementaires as $champSupplementaire)
                                                <li>{{ $champSupplementaire->libelle }}: {{ $champSupplementaire->montant }} FCFA</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="colonne-verte" style="font-size: 20px;  color: black; background-color:#00FF00;">
                                            {{ $ractivite->sommeTotale }} FCFA
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            @if($ractivite->validation_finance == "valider")
                                            <a class="badge badge-success" style="font-size: 16px; color: white;">{{ $ractivite->validation_finance }}</a>
                                            @elseif($ractivite->validation_finance == "rejeter")
                                            <a class="badge badge-danger" style="font-size: 16px; color: white;">{{ $ractivite->validation_finance }}</a>
                                            @else
                                            <a class="badge badge-info" style="font-size: 16px; color: black;">{{ $ractivite->validation_finance }}</a>
                                            @endif
                                        </td>

                                        <td style="font-size: 16px; color: black;">
                                            {{ $ractivite->motif1 }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            @if($ractivite->validation_raf == "valider")
                                            <a class="badge badge-success" style="font-size: 16px; color: white;">{{ $ractivite->validation_raf }}</a>
                                            @elseif($ractivite->validation_raf == "rejeter")
                                            <a class="badge badge-danger" style="font-size: 16px; color: white;">{{ $ractivite->validation_raf }}</a>
                                            @else
                                            <a class="badge badge-info" style="font-size: 16px; color: black;">{{ $ractivite->validation_raf }}</a>
                                            @endif
                                        </td>

                                        <td style="font-size: 16px; color: black;">
                                            {{ $ractivite->motif2 }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            <div class="action">
                                                <form action="{{ url('/validationractivite2', $ractivite->id) }}" method="POST" class="actions">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="badge badge-success">Valider</button>
                                                </form>
                                                <form action="{{ url('/rejetractivite2', $ractivite->id) }}" method="POST" class="actions">
                                                    @csrf
                                                    <div>
                                                        <input type="text" class="form-control" name="motif" required>
                                                    </div>
                                                    <button type="submit" class="badge badge-danger">Rejeter</button>
                                                </form>
                                            </div>
                                        </td>

                                        <!-- @can('role-list')
                                        <td style="font-size: 16px; color: black;">
                                            {{ $ractivite->enregistrer }} le
                                            {{ $ractivite->created_at }}
                                        </td>
                                        @if ($ractivite->modifier == '')
                                        <td style="font-size: 16px; color: black;">
                                            {{ $ractivite->modifier }}
                                        </td>
                                        @else
                                        <td style="font-size: 16px; color: black;">
                                            {{ $ractivite->modifier }} le
                                            {{ $ractivite->updated_at }}
                                        </td>
                                        @endif
                                        @endcan -->
                                        <!-- <td class="text-end">
                                            <div class="actions" style="display: flex;">
                                                <form action="{{ route('ractivites.destroy', $ractivite->id) }}" method="POST" class="actions">

                                                    <a href="{{ route('ractivites.show', $ractivite->id) }}" class="btn btn-sm bg-danger-light">
                                                        <i style="font-size: 16px; color: black;" class="fab fa-phabricator"></i>
                                                    </a>

                                                    @can('ractivite-modifier')
                                                    <a href="{{ route('ractivites.edit', $ractivite->id) }}" class="btn btn-sm bg-danger-light student_delete">
                                                        <i style="font-size: 16px; color: black;" class="feather-edit"></i>
                                                    </a>
                                                    @endcan



                                                    @csrf
                                                    @method('DELETE')
                                                    @can('mission-supprimer')
                                                    <button type="submit" class="btn btn-sm bg-danger-light">
                                                        <i style="font-size: 16px; color: black;" class="feather-trash-2 me-1"></i>
                                                    </button>
                                                    @endcan



                                                </form>
                                            </div>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>




                            <div id="pagination">{!! $ractivites->links() !!}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Personnalisation du style de la barre de recherche */
    .dataTables_filter input[type="search"] {
        border: 3px solid #f4823c;
        border-radius: 15px;
        /* Bordure de 2 pixels avec la couleur de votre choix */
        color: #000000;
        /* Couleur du texte */
        font-family: Arial, sans-serif;
        /* Police de caractères */
        font-size: 16px;
        /* Taille de la police */
        /* Ajoutez d'autres styles selon vos besoins */
    }
</style>

{{-- model student delete --}}


<div class="modal fade contentmodal" id="supp" tabindex="QX" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <form action="" method="POST" class="actions">
                <div class="modal-body">
                    <div class="delete-wrap text-center">
                        <div class="del-icon">
                            <i class="feather-x-circle"></i>
                        </div>

                        <h2>Vous voulez vraiment Supprimer? </h2>
                        <div class="submit-section">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success me-2">OUI</button>
                            <a class="btn btn-danger" data-bs-dismiss="modal">NON</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#example1').DataTable({
            dom: 'Bfrtip',
            destroy: true,
            paging: false,
            paging: false,
            "searching": true,
            "search": {
                "caseInsensitive": true, // Recherche insensible à la casse
                "regex": true, // Utilise des expressions régulières dans la recherche
            },
            language: {
                search: "RECHERCHER :" // Remplace "Search :" par "Rechercher :"
            },

            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel" style="font-size:20px;color:green"> Excel</i>',
                    title: 'LISTE DES ACTIVITES',
                    className: 'display:none',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12

                        ] // Inclure les colonnes 1, 2, et 3 dans le excel
                    },
                },


                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf" style="font-size:20px;color:red"> Pdf</i>',
                    title: 'LISTE DES RAPPORTS DES ACTIVITES',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12

                        ] // Inclure les colonnes 1, 2, et 3 dans le PDF
                    },

                },


                {
                    extend: 'print',
                    text: '<i class="fas fa-file-powerpoint" style="font-size:20px;color:blue"> Imprimer</i>',
                    title: 'LISTE DES ACTIVITES',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12

                        ] // Inclure les colonnes 1, 2, et 3 dans le imprimer
                    },
                },

            ]
        });
    });
</script>

{{-- delete js --}}
<script>
    $(document).on('click', '.student_delete', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
        $('.e_avatar').val(_this.find('.avatar').text());
    });
</script>
@endsection

@endsection