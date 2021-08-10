<div class="form-group">
    {!! Form::label('codigoUbigeoDistrito', 'Distrito ') !!}
    {!! Form::select('codigoUbigeoDistrito',$districts, null, ['class' => 'form-control department', 'placeholder' => 'Seleccione Distrito...', 'style' => 'width:100%;']) !!}
    
    @error('codigoUbigeoDistrito')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>   
    @enderror
</div>

<div class="form-group">
    {!! Form::label('codigoCentroPobladoMINEDU', 'Codigo Centro Poblado MINEDU ') !!}
    {!! Form::text('codigoCentroPobladoMINEDU', null, ['class' => 'form-control' . ($errors->has('codigoCentroPobladoMINEDU') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Centro Poblado MINEDU', 'maxlength' => '6']) !!}
    @error('codigoCentroPobladoMINEDU')
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
    {!! Form::label('x', 'Latitud ') !!}
    {!! Form::text('x', null, ['class' => 'form-control' . ($errors->has('x') ? ' is-invalid' : ''), 'placeholder' => 'Latitud']) !!}
    @error('x')
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
    {!! Form::label('name', 'Estado: ') !!}
    {!! Form::select('estado', [1 => 'Disponible', 0 => 'No Disponible'], null, ['class' => 'form-control']) !!}
</div>