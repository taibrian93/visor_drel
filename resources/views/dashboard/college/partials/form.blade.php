<div class="form-group">
    {!! Form::label('codigoCentroPobladoMINEDU', 'Centro Poblado: ') !!}
    {!! Form::select('codigoCentroPobladoMINEDU',$populationCenters, null, ['class' => 'form-control populationCenter', 'placeholder' => 'Seleccione Centro Poblado...', 'style' => 'width: 100%;']) !!}
    
    @error('codigoCentroPobladoMINEDU')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('codigoLocal', 'Codigo Local ') !!}
    {!! Form::text('codigoLocal', null, ['class' => 'form-control' . ($errors->has('codigoLocal') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Local']) !!}
    @error('codigoLocal')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('codigoModular', 'Codigo Modular ') !!}
    {!! Form::text('codigoModular', null, ['class' => 'form-control' . ($errors->has('codigoModular') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Modular']) !!}
    @error('codigoModular')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('nombreCentroEducativo', 'Nombre Centro Educativo ') !!}
    {!! Form::text('nombreCentroEducativo', null, ['class' => 'form-control' . ($errors->has('nombreCentroEducativo') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Centro Educativo']) !!}
    @error('nombreCentroEducativo')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('nombreDirector', 'Nombre Director ') !!}
    {!! Form::text('nombreDirector', null, ['class' => 'form-control' . ($errors->has('nombreDirector') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Director']) !!}
    @error('nombreDirector')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('direccionCentroEducativo', 'Direccion Centro Educativo ') !!}
    {!! Form::text('direccionCentroEducativo', null, ['class' => 'form-control' . ($errors->has('direccionCentroEducativo') ? ' is-invalid' : ''), 'placeholder' => 'Direccion Centro Educativo']) !!}
    @error('direccionCentroEducativo')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('y', 'Longitud ') !!}
    {!! Form::text('y', null, ['class' => 'form-control' . ($errors->has('y') ? ' is-invalid' : ''), 'placeholder' => 'Longitud']) !!}
    @error('y')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('x', 'Latitud ') !!}
    {!! Form::text('x', null, ['class' => 'form-control' . ($errors->has('x') ? ' is-invalid' : ''), 'placeholder' => 'Latitud']) !!}
    @error('x')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Estado: ') !!}
    {!! Form::select('estado', [1 => 'Disponible', 0 => 'No Disponible'], null, ['class' => 'form-control']) !!}
    
</div>