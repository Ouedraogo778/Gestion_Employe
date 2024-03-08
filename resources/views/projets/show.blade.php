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
                color:white;
                background-color:blue;

                transition: all ease-in-out 0.3s;
                font-size: 18px;
                border-radius: 12px;
            }
        </style>

        <br>


        <div class="col-lg-12 margin-tb">
            @can('employe-liste')
            <div class="pull-right" style="text-align: center;">
                <a class="mote btn" href="{{ route('projets.index') }}">Liste des projets
                    </a>
            </div>
            @endcan

        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="card-header text-center" style="background-color:blue;">
                                <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Infomation du projet</h3>
                            </div>
                        </div>


                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <br>
                            <br>
                            <div class="form-group local-forms">

                                <strong style="color: red"><u>Code: </u> </strong>
                                {{ $projet->codeprojet }}


                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <br>
                            <br>
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Prenom: </u> </strong>
                                {{ $projet->nom }}

                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <br>
                            <br>
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Date de début: </u></strong>
                                {{ $projet->datedebut}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Date de fin: </u></strong>
                                {{ $projet->datefin}}
                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Date de creation: </u></strong>
                                {{ $projet->datecreation}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection