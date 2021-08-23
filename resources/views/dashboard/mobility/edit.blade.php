@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Trayectoria</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('route.trajectorie', $trajectorie->route->id) }}"> Trayectoria</a></li>
                <li class="breadcrumb-item active"> Editar Trayectoria</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {!! Form::model($mobility, ['route' => ['mobility.update', $mobility, 'idTrajectorie' => $trajectorie->id], 'method' => 'put' ]) !!}
                    <div class="card-header">
                        <h3 class="card-title">
                            Editar Trayectoria
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        @include('dashboard.mobility.partials.form')
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Editar
                        </button>

                        {{-- <button type="submit" class="btn btn-warning ml-2">
                            <i class="fas fa-times-circle"></i>
                            Cancelar
                        </button> --}}

                        <a href="{{ route('trajectorie.mobility', $trajectorie)}}" class="btn bg-warning ml-2" title="Cancelar">
                            <i class="fas fa-times-circle"></i>
                            Cancelar
                        </a>
                    </div>
                {!! Form::close() !!}
            </div>

            @include('dashboard.mobility.partials.table')
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/mobility.js') }}"></script>
@stop
