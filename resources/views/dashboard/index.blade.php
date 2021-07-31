@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Inicio</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> Inicio</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{ $colleges }}</h3>
                    <p>Colegios</p>
                </div>
                <div class="icon">
                    <i class="fas fa-university"></i>
                </div>
                <a href="{{ route('college.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-olive">
                <div class="inner">
                    <h3>{{ $populationCenters }}</h3>
                    <p>Centro Poblados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-city"></i>
                </div>
                <a href="{{ route('populationCenter.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-lightblue">
                <div class="inner">
                    <h3>{{ $users }}</h3>
                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href=" " class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
