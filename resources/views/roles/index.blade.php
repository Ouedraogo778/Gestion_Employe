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

                .mote {
                    color: black;
                    background-color: #BBD2E1;
                   

                }

              
                .titre{
                    border-left: 6px solid #f4823c;
                    border-right: 6px solid #f4823c;
                }
            </style>

           <br>



            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow" >
                    <div class="card-header text-center" style="background-color: blue;">
                    <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Liste des rôle</h3>
                </div>
                        <div class="card-body">
                           

                            <hr style="border: 2px solid black;">

                            <div class="table-responsive">

                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                                <table class="table table-bordered">
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">voir</a>
                                                @can('role-edit')
                                                    <a class="btn btn-primary"
                                                        href="{{ route('roles.edit', $role->id) }}">Modifier</a>
                                                @endcan
                                                @can('role-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                                <div style="align-items: center;"> {!! $roles->render() !!}</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- model student delete --}}
    <div class="modal fade contentmodal" id="studentUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="delete-wrap text-center">
                        <div class="del-icon">
                            <i class="feather-x-circle"></i>
                        </div>

                        <h2>Vous voulez vraiment Supprimer le projet ? </h2>
                        <div class="submit-section">
                            <a href="" class="btn btn-success me-2">OUI</a>
                            <a class="btn btn-danger" data-bs-dismiss="modal">NON</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
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
