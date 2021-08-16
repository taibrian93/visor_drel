{{-- <div class="form-group">
    {!! Form::label('conveyance', 'Medio Transporte: ') !!}
    {!! Form::select('conveyance',$conveyance, null, ['class' => 'form-control', 'style' => 'width: 100%;']) !!}
    
    @error('conveyance')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div> --}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Punto Partida</label>
            <p class="border border-secondary bg-light text-dark p-2 rounded text-justify">{{ Helper::getDescriptionPopulationCenter($trajectorie->puntoPartida) }}</p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Punto Llegada</label>
            <p class="border border-secondary bg-light text-dark p-2 rounded text-justify">{{ Helper::getDescriptionPopulationCenter($trajectorie->puntoLlegada) }}</p>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('conveyances', 'Medio Transporte: ') !!}
    {!! Form::select('conveyances',$conveyances, null, ['class' => 'form-control conveyances', 'placeholder' => 'Seleccione Medio Transporte...', 'style' => 'width: 100%;']) !!}
    
    @error('conveyances')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('idTypeTransportation', 'Tipo Transporte: ') !!}
    {!! Form::select('idTypeTransportation',[], null, ['class' => 'form-control idTypeTransportation', 'disabled' => '','style' => 'width: 100%;']) !!}
    
    @error('idTypeTransportation')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('costo', 'Costo ') !!}
    {!! Form::text('costo', null, ['class' => 'form-control costo' . ($errors->has('costo') ? ' is-invalid' : ''), 'placeholder' => 'Costo']) !!}
    @error('costo')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Estado: ') !!}
    {!! Form::select('estado', [1 => 'Disponible', 0 => 'No Disponible'], null, ['class' => 'form-control']) !!}
</div>

