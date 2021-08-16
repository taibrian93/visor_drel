@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Movilidad</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('route.trajectorie', $trajectorie->route->id) }}"> Trayectoria</a></li>
                <li class="breadcrumb-item active"> Crear Movilidad</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {!! Form::open(['route' => ['mobility.store', 'idTrajectorie' => $trajectorie->id]]) !!}
                    <div class="card-header">
                        <h3 class="card-title">
                            Crear Movilidad
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        @include('dashboard.mobility.partials.form')
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Lista de Movilidad
                    </h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <x-table>
                        @slot('thead')
                            <tr>
                                <th>Nro</th>
                                <th>Tipo Transporte</th>
                                <th>Costo</th>
                                <th></th>
                            </tr>
                        @endslot

                        @slot('tbody')
                            @foreach ($mobilities as $key => $mobility)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $mobility->typeTransportation->descripcion }}</td>
                                    <td>S/. {{ $mobility->costo }}</td>
                                    
                                    <td>
                                        <a href="{{ route('college.edit', $mobility)}}" class="btn bg-lightblue btn-sm" title="Transporte">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn btn-danger btn-sm delete" trajectorie="{{ $trajectorie->id }}" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
    <script src="{{ asset('js/mobility.js') }}"></script>
@stop
