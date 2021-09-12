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
    {!! Form::label('province', 'Provincia: ') !!}
    {!! Form::select('province',$province, null, ['class' => 'form-control province', 'style' => 'width: 100%;']) !!}
    
    @error('province')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('district', 'Distrito: ') !!}
    {!! Form::select('district', $district, null, ['class' => 'form-control district', 'style' => 'width: 100%;', 'routeIdCollege' => $route->idCollege, 'routeId' => $route->id]) !!}
    
    @error('district')
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
    
    <div class="form-check form-check-inline">
        {!! Form::label('destinoFinal', 'Destino Final: ') !!}
        <input class="form-check-input ml-2 checkDestinoFinal" type="checkbox" id="destinoFinal" value="1">
    </div>
    {!! Form::select('puntoLlegada',$destinoFinal, null, ['id' => 'destinoFinal','class' => 'form-control destinoFinal', 'style' => 'width: 100%;', 'disabled' => '']) !!}
    
    @error('puntoLlegada')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
</div>