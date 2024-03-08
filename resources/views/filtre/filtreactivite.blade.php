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



        <br><br>

        <br>



        <div class="row activites-container">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-header text-center" style="background-color:blue;">
                        <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Ajouter une activité</h3>
                    </div>

                    <div class="card-body">



                        <div class="page-header">

                            <div class="row align-items-center">

                                <div class="col-auto text-end float-end ms-auto download-grp">

                                    @can('activite-ajouter')
                                    <a href="{{ route('activites.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter une activité</a>
                                    @endcan

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">



                            <h3 id="error" class="text-center mt-3"></h3>



                            <!--  -------------   debut  message de retour  ------------------------------- -->
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            <!--  -------------   fin  message de retour  ------------------------------- -->


                            <table id="example1" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">


                                <thead class="student-thread" id="entete">
                                    <tr>

                                        <th style="font-size: 18px; ">N°</th>
                                        <th style="font-size: 18px; ">Code du projet </th>
                                        <th style="font-size: 18px; ">Employé</th>
                                        <th style="font-size: 18px; ">Code activité</th>
                                        <th style="font-size: 18px; ">Nom de l'activite</th>
                                        <th style="font-size: 18px; ">TDR</th>
                                        <th style="font-size: 18px; ">Expression de besoin</th>
                                        <th style="font-size: 18px; ">Objectif</th>
                                        <th style="font-size: 18px; ">Budget</th>
                                        <th style="font-size: 18px; ">Localité</th>
                                        <th style="font-size: 18px; ">Description</th>
                                        <th style="font-size: 18px; ">Date début</th>
                                        <th style="font-size: 18px; ">Date fin</th>
                                        <th style="font-size: 18px; ">Etat finance</th>
                                        <th style="font-size: 18px; ">Motif rejet finance</th>
                                        <th style="font-size: 18px; ">Etat RAF</th>
                                        <th style="font-size: 18px; ">Motif rejet RAF</th>
                                        <th style="font-size: 18px; ">Etat Supperieur</th>
                                        <th style="font-size: 18px; ">Motif rejet Supperieur</th>


                                        @can('role-list')
                                        <th style="font-size: 18px; color: black;">Enregistrer par</th>
                                        <th style="font-size: 18px; color: black;">Modifier par</th>
                                        @endcan

                                    </tr>
                                </thead>


                                <tbody id="Table">

                                    @foreach ($activites as $activite)
                                    <tr>

                                        <td style="font-size: 16px; color: black;">{{ ++$i }}</td>

                                        <td style="font-size: 16px; color: black; ">{{ $activite->projet_id }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $activite->employe_id }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $activite->code }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">{{ $activite->nom }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            @if ($activite->pdf_tdr)
                                            <a href="{{ asset('storage/' . $activite->pdf_tdr) }}" target="_blank" class="badge badge-success">
                                                Voir le PDF
                                            </a>
                                            @else
                                            Aucun fichier PDF
                                            @endif
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            @if ($activite->pdf_besoin)
                                            <a href="{{ asset('storage/' . $activite->pdf_besoin) }}" target="_blank" class="badge badge-success">
                                                Voir le PDF
                                            </a>
                                            @else
                                            Aucun fichier PDF
                                            @endif
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->objectif }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">{{ $activite->budget }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $activite->localite }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->description }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->datedebut }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->datefin }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->validation_finance }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->motif1 }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->validation_raf }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->motif2 }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->validation_supperieur }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->motif3 }}
                                        </td>
                                        @can('role-list')
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->enregistrer }} le
                                            {{ $activite->created_at }}
                                        </td>
                                        @if ($activite->modifier == '')
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->modifier }}
                                        </td>
                                        @else
                                        <td style="font-size: 16px; color: black;">
                                            {{ $activite->modifier }} le
                                            {{ $activite->updated_at }}
                                        </td>
                                        @endif
                                        @endcan

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            <div id="pagination">{!! $activites->links() !!}</div>

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
        border: 3px solid #0000FF;
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

            buttons: [

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