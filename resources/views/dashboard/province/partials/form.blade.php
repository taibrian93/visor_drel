<div class="form-group">
    {!! Form::label('idDepartment', 'Departamento ') !!}
    {!! Form::select('idDepartment',$departments, null, ['class' => 'form-control department', 'placeholder' => 'Seleccione Departamento...', 'style' => 'width:100%;']) !!}
    
    @error('idDepartment')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>   
    @enderror
</div>

<div class="form-group">
    {!! Form::label('codigoUbigeo', 'Codigo Ubigeo ') !!}
    {!! Form::text('codigoUbigeo', null, ['class' => 'form-control codigoUbigeo' . ($errors->has('codigoUbigeo') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Ubigeo', 'maxlength' => '4']) !!}
    @error('codigoUbigeo')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion ') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) !!}
    @error('descripcion')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Estado: ') !!}
    {!! Form::select('estado', [1 => 'Disponible', 0 => 'No Disponible'], null, ['class' => 'form-control']) !!}
</div>