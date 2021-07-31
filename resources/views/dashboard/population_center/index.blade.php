@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Centro Poblado</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item active"> Centro Poblado</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('populationCenter.create') }}" class="btn btn-success">
                Crear Centro Poblado
            </a>
        </div>
    </div>
    @livewire('table.table', ['name' => 'populationCenter', 'model' => $populationCenter])


@stop

@section('css')

@stop

@section('js')
    <script>
        

        
    </script>
@stop
