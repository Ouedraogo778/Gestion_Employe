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
                    color: black;
                    background-color: #f4823c;
                    border: 2px solid black;
                    transition: all ease-in-out 0.3s;
                    font-size: 18px;
                    border-radius: 12px;

                }

                .mote:hover {
                    color: rgb(255, 255, 255);
                    background-color: rgb(80, 98, 216);
                    border: 2px solid #f4823c;
                    border-radius: 12px;

                }
                .titre{
                    border-left: 6px solid #f4823c;
                    border-right: 6px solid #f4823c;
                }
            </style>

           

            <br>


            <br>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                    <div class="card-header text-center" style="background-color: #BBD2E1;">
                    <h3>Modifier son password</h3>
                </div>
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

                                <form action="/changepassword" method="post">
                                    @csrf
                                <div class="form-group">
                                    {!! Form::label('current_password', 'Ancien mot de passe') !!}
                                    {!! Form::password('current_password', ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('new_password', 'Nouveau mot de passe') !!}
                                    {!! Form::password('new_password', ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('new_password_confirmation', 'Confirmer le nouveau mot de passe') !!}
                                    {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Modifier le mot de passe', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
