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
                background-color:blue;

                transition: all ease-in-out 0.3s;
                font-size: 18px;
                border-radius: 12px;
            }
        </style>

        

        <br>


        <div class="col-lg-12 margin-tb">
            @can('activite-liste')
            <div class="pull-right" style="text-align: center;">
                <a class="mote btn" href="{{ route('activites.index') }}">Liste des activités
                    </a>
            </div>
            @endcan

        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="card-header text-center" style="background-color: blue;">
                                <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Infomation de l'activité</h3>
                            </div>
                        </div>


                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <br>
                            <br>
                            <div class="form-group local-forms">
                                <strong style="color: blue"><u>Projet:</u></strong>
                                
                                {{ $activite->projet_id }}
                               
                               
                                <!-- Accédez à d'autres propriétés du projet si nécessaire -->
                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <br>
                            <br>
                            <div class="form-group local-forms">
                                <strong style="color: blue"><u>Employe:</u></strong>
                              
                                {{ $activite->employe_id }}
                              
                                <!-- Accédez à d'autres propriétés du projet si nécessaire -->
                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <br>
                            <br>
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>code: </u></strong>
                                {{ $activite->code}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Nom:</u> </strong>
                                {{ $activite->nom }}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: rgb(0, 0, 0)"><u>TDR</u>:</strong>
                                @if ($activite->pdf_tdr)
                                <a href="{{ asset('storage/' . $activite->pdf_tdr) }}" target="_blank" class="badge badge-success">
                                    Voir le PDF
                                </a>
                                @else
                                Aucun fichier PDF
                                @endif

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: rgb(0, 0, 0)"><u>Besoin</u>:</strong>
                                @if ($activite->pdf_besoin)
                                <a href="{{ asset('storage/' . $activite->pdf_besoin) }}" target="_blank" class="badge badge-success">
                                    Voir le PDF
                                </a>
                                @else
                                Aucun fichier PDF
                                @endif

                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Objectif:</u> </strong>
                                {{ $activite->objectif}}
                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Budget:</u> </strong>
                                {{ $activite->budget}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>localite:</u> </strong>
                                {{ $activite->localite }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Description:</u> </strong>
                                {{ $activite->description }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Date début:</u> </strong>
                                {{ $activite->datedebut }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group local-forms">
                                <strong style="color: red"><u>Date fin:</u> </strong>
                                {{ $activite->datefin }}
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection