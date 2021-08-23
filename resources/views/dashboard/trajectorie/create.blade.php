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
                <li class="breadcrumb-item"><a href="{{ route('route.index') }}"> Ruta</a></li>
                <li class="breadcrumb-item active"> Crear Trayectoria</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {!! Form::open(['route' => ['trajectorie.store', 'idRoute' => $route->id] ]) !!}
                    <div class="card-header">
                        <h3 class="card-title">
                            Crear Trayectoria - {{ $route->descripcion }}
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        @include('dashboard.trajectorie.partials.form')
                    </div>
                    <div class="card-footer d-flex justify-content-end">

                        @if (!$check)
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Guardar
                            </button> 
                        @endif
                        
                    </div>
                {!! Form::close() !!}
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Lista de Trayectorias
                    </h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <x-table>
                        @slot('thead')
                            <tr>
                                <th>Orden</th>
                                <th>Provincia - Centro Poblado (PP*)</th>
                                <th>Provincia - Centro Poblado (PL*)</th>
                                <th>Distancia</th>
                                <th style="width: 10%"></th>
                            </tr>
                        @endslot

                        @slot('tbody')
                            @foreach ($trajectories as $key => $trajectorie)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ Helper::getDescriptionPopulationCenter($trajectorie->puntoPartida) }}</td>
                                    <td>{{ Helper::getDescriptionPopulationCenter($trajectorie->puntoLlegada) }}</td>
                                    <td>{{ $trajectorie->distancia.' km' }}</td>
                                    <td>
                                        <a href="{{ route('trajectorie.mobility', $trajectorie)}}" class="btn bg-warning btn-sm" title="Transporte">
                                            <i class="fas fa-bus"></i>
                                        </a>

                                        @if (($trajectories->count()) - 1 == $key)
                                            <a href="#" class="btn btn-danger btn-sm delete" trajectorie="{{ $trajectorie->id }}" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>
                </div>

                <div class="card-footer py-1 my-0">
                    <p class="font-weight-light py-0 my-0">PP: Punto Partida</p>
                    <p class="font-weight-light py-0 my-0">PL: Punto Llegada</p>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/trajectorie.js') }}"></script>
@stop
