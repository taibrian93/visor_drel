@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Ruta</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('route.index') }}"> Ruta</a></li>
                <li class="breadcrumb-item active"> Editar Ruta</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {!! Form::model($route, ['route' => ['route.update', $route], 'method' => 'put' ]) !!}
                    <div class="card-header">
                        <h3 class="card-title">
                            Editar Ruta
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        @include('dashboard.route.partials.form')
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Editar
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
    <script src="{{ asset('js/route.js') }}"></script>
@stop
