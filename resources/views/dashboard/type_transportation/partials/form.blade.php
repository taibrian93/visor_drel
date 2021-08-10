<div class="form-group">
    {!! Form::label('idConveyance', 'Medio Transporte ') !!}
    {!! Form::select('idConveyance',$conveyances, null, ['class' => 'form-control department', 'placeholder' => 'Seleccione Medio Transporte...', 'style' => 'width:100%;']) !!}
    
    @error('idConveyance')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>   
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