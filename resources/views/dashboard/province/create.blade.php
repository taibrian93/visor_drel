@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Provincia</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('province.index') }}"> Provincia</a></li>
                <li class="breadcrumb-item active"> Crear Provincia</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {!! Form::open(['route' => 'province.store']) !!}
                    <div class="card-header">
                        <h3 class="card-title">
                            Crear Provincia
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        @include('dashboard.province.partials.form')
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')
    
@stop
