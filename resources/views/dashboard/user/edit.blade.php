@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Usuario</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}"> Usuario</a></li>
                <li class="breadcrumb-item active"> Editar Usuario</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {!! Form::model($user, ['route' => ['user.update', $user], 'method' => 'put' ]) !!}
                    <div class="card-header">
                        <h3 class="card-title">
                            Editar Usuario
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        @include('dashboard.user.partials.form')
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
    <script>
        
        $('.populationCenter').select2();
        
    </script>
@stop
