<div class="form-group">
    {!! Form::label('puntoPartida', 'Punto Partida: ') !!}
    {!! Form::select('puntoPartida',$puntoPartida, null, ['class' => 'form-control', 'style' => 'width: 100%;']) !!}
    
    @error('puntoPartida')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div>


<div class="form-group">
    {!! Form::label('puntoLlegada', 'Punto Llegada: ') !!}
    {!! Form::select('puntoLlegada',$puntoLlegada, null, ['class' => 'form-control puntoLlegada', 'placeholder' => 'Seleccione Punto Llegada...', 'style' => 'width: 100%;']) !!}
    
    @error('puntoLlegada')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('puntoLlegada', 'Destino Final: ') !!}
    {!! Form::select('puntoLlegada',$destinoFinal, null, ['class' => 'form-control', 'style' => 'width: 100%;', 'disabled' => '']) !!}
    
    @error('puntoLlegada')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div>