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
                background-color: #BBD2E1;
               

            }

            

            .titre {
                border-left: 6px solid #f4823c;
                border-right: 6px solid #f4823c;
            }
        </style>



        <br><br>
        <div class="col-lg-12 margin-tb">
            <div class="pull-right" style="text-align: center; font-family: Arial, Helvetica, sans-serif;">
                <a class="mote btn " style="" href="{{ route('users.index') }}">Liste des utilisateurs</a>
            </div>
        </div>
        <br>



        <div class="row" id="show">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-header text-center" style="background-color: #BBD2E1;">
                        <h3>Information d'un utilisateur</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            

                            <div class="col-xs-12 col-sm-12 col-md-12" style="font-size: 22px;">
                                <div class="form-group">
                                    <strong>Nom & Prénom:</strong>
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="font-size: 22px;">
                                <div class="form-group">
                                    <strong>E-mail:</strong>
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" style="font-size: 22px;">
                                <div class="form-group">
                                    <strong>Roles:</strong>
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                    @endif
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