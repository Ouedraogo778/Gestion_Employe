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
                    <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Validation de mission</h3>
                </div>
                    <div class="card-body">

                        <!-- <div class="page-header">
                            <div class="row align-items-center">

                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    @can('mission-ajouter')
                                    <a href="{{ route('missions.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter une information</a>
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
                                        <th style="font-size: 18px; ">Nom de la mission</th>
                                        <th style="font-size: 18px; ">Odre mission</th>
                                        <!-- <th style="font-size: 18px; ">Expression de besoin</th> -->
                                        <th style="font-size: 18px; ">Objectif</th>
                                        <th style="font-size: 18px; ">Budget</th>
                                        <th style="font-size: 18px; ">Localité</th>
                                        <th style="font-size: 18px; ">Description</th>
                                        <th style="font-size: 18px; ">Date début</th>
                                        <th style="font-size: 18px; ">Date fin</th>
                                        <th style="font-size: 18px; width: 200px;">Validation Coordination</th>


                                        <!-- @can('role-list')
                                        <th style="font-size: 18px; color: black;">Enregistrer par</th>
                                        <th style="font-size: 18px; color: black;">Modifier par</th>
                                        @endcan
                                        <th class="text-end" style="font-size: 18px; color: black;">Action</th> -->
                                    </tr>
                                </thead>


                                <tbody id="Table">

                                    @foreach ($missions as $mission)
                                    <tr>

                                        <td style="font-size: 16px; color: black;">{{ ++$i }}</td>

                                        <td style="font-size: 16px; color: black; ">{{ $mission->projet_id }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $mission->employe_id }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $mission->code }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">{{ $mission->nom }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            @if ($mission->pdf_odremission)
                                            <a href="{{ asset('storage/' . $mission->pdf_odremission) }}" target="_blank" class="badge badge-success">
                                                Voir le PDF
                                            </a>
                                            @else
                                            Aucun fichier PDF
                                            @endif
                                        </td>
                                        
                                        <td style="font-size: 16px; color: black;">
                                            {{ $mission->objectif }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">{{ $mission->budget }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $mission->localite }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $mission->description}}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $mission->datedebut }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                        {{ $mission->datefin }}</td>

                                        <td style="font-size: 16px; color: black;">

                                            <div class="action">
                                                <form action="{{ url('/validationmission1', $mission->id) }}" method="POST" class="actions">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="badge badge-success">Valider</button>
                                                </form>
                                                <form action="{{ url('/rejetmission1', $mission->id) }}" method="POST" class="actions">
                                                    @csrf
                                                    <div >
                                                        <input type="text" class="form-control" name="motif" required>
                                                    </div>
                                                    <button type="submit" class="badge badge-danger">Rejeter</button>
                                                </form>
                                            </div>
                                        </td>

                                        <!-- @can('role-list')
                                        <td style="font-size: 16px; color: black;">
                                            {{ $mission->enregistrer }} le
                                            {{ $mission->created_at }}
                                        </td>
                                        @if ($mission->modifier == '')
                                        <td style="font-size: 16px; color: black;">
                                            {{ $mission->modifier }}
                                        </td>
                                        @else
                                        <td style="font-size: 16px; color: black;">
                                            {{ $mission->modifier }} le
                                            {{ $mission->updated_at }}
                                        </td>
                                        @endif
                                        @endcan -->
                                        <!-- <td class="text-end">
                                            <div class="actions" style="display: flex;">
                                                <form action="{{ route('missions.destroy', $mission->id) }}" method="POST" class="actions">

                                                    <a href="{{ route('missions.show', $mission->id) }}" class="btn btn-sm bg-danger-light">
                                                        <i style="font-size: 16px; color: black;" class="fab fa-phabricator"></i>
                                                    </a>

                                                    @can('activite-modifier')
                                                    <a href="{{ route('missions.edit', $mission->id) }}" class="btn btn-sm bg-danger-light student_delete">
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




                            <div id="pagination">{!! $missions->links() !!}</div>

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
                    title: 'LISTE DES MISSIONS',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12

                        ] // Inclure les colonnes 1, 2, et 3 dans le PDF
                    },

                },


                {
                    extend: 'print',
                    text: '<i class="fas fa-file-powerpoint" style="font-size:20px;color:blue"> Imprimer</i>',
                    title: 'LISTE DES MISSIONS',
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