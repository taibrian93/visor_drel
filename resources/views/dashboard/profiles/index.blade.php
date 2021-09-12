@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Mi perfil</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item active"> Mi perfil</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @if (session('info') || session('success'))
            
                    <div class="card {{ session('info') ? 'card-danger' : 'card-success'}}">
                        <div class="card-header">
                            <h3 class="card-title">{{ session('info') ? '¡Error!' : '¡Exito!'}}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{ session('info') ? session('info') : session('success') }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                                    
                @endif

                <div class="card">
                    <div class="card-body">
                        {!! Form::model($user, ['route' => ['user.updateProfile',$user], 'method' => 'put' ]) !!}
                        @include('dashboard.profiles.partials.form')

                        {!! Form::submit('Actualizar Perfil', ['class' => 'btn btn-primary mt-2 btn-submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    

@stop