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

        <div class="col-lg-12 margin-tb">
            <div class="titre">
                <h2 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >GESTION DES EMPLOYES</h2>
            </div>
        </div>

        <br>


        <div class="col-lg-12 margin-tb">
            @can('employe-liste')
            <div class="pull-right" style="text-align: center;">
                <a class="mote btn" href="{{ route('employes.index') }}">-- Liste des informations des
                    employés --</a>
            </div>
            @endcan

        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="card-header text-center" style="background-color: #BBD2E1;">
                                <h3>Infomation de l'employé</h3>
                            </div>
                        </div>


                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <br>
                            <br>
                            <div class="form-group local-forms">

                                <strong style="color: red"><u>Nom & Prenom </u> </strong>
                                {{ $employe->nom_prenom }}


                            </div>
                        </div>



                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <br>
                            <br>
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Date naissance: </u></strong>
                                {{ $employe->datenaissance}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Genre:</u> </strong>
                                {{ $employe->genre }}
                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Telephone:</u> </strong>
                                {{ $employe->telephone}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Email:</u> </strong>
                                {{ $employe->email}}
                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Poste:</u> </strong>
                                {{ $employe->poste}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Date d'embauche:</u> </strong>
                                {{ $employe->dateembauche }}
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection