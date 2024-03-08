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

            }


            .titre {
                border-left: 6px solid #f4823c;
                border-right: 6px solid #f4823c;
            }
        </style>

        <br>
        <div class="col-lg-12 margin-tb">
            <div class="pull-right" style="text-align: center; font-family: Arial, Helvetica, sans-serif;">
                <a class="mote btn " href="{{ route('roles.index') }}">Liste des roles</a>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-header text-center" style="background-color:blue;">
                        <h3 style="font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);" >Information rôle</h3>
                    </div>
                    <div class="card-body">

                        

                        <hr style="border: 1px solid black;"><br>

                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group">
                                <strong>Nom:</strong>
                                {{ $role->name }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="font-size: 22px;">
                            <div class="form-group">
                                <strong>Permission:</strong>
                                @if (!empty($rolePermissions))
                                @foreach ($rolePermissions as $v)
                                <label class="label label-success">{{ $v->name }}, </label>
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="col-12">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection