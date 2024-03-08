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



        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                <div class="card-header text-center" style="background-color: blue;">
                                    <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Liste des missions exécutées</h3>
                                </div>
                    <div class="card-body">

                        
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
                                        <th style="font-size: 18px; ">Code de la mission</th>
                                        
                                        <th style="font-size: 18px; ">Date de chargement</th>


                                        
                                    </tr>
                                </thead>


                                <tbody id="Table">

                                    @foreach ($rmissions as $rmission)
                                    <tr>

                                        <td style="font-size: 16px; color: black;">{{ ++$i }}</td>

                                        <td style="font-size: 16px; color: black; ">{{ $rmission->projet_id }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $rmission->employe_id }}</td>
                                        <td style="font-size: 16px; color: black;">{{ $rmission->mission_id }}
                                        </td>
                                        <td style="font-size: 16px; color: black;">{{ $rmission->datechargement }}
                                        </td>
                                        
                                        

                                       
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>




                            <div id="pagination">{!! $rmissions->links() !!}</div>

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