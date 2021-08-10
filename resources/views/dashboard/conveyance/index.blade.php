@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Medio Transporte</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item active"> Medio Transporte</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <x-card-success />

    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('conveyance.create') }}" class="btn btn-success">
                Crear Medio Transporte
            </a>
        </div>
    </div>
    @livewire('table.table', ['name' => 'conveyance', 'model' => $conveyance])


@stop

@section('css')

@stop

@section('js')
    <script>
        

        
    </script>
@stop
