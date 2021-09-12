<div class="form-group">
    <label for="">Buscar Colegio </label>
    <div class="input-group">
        
        <div class="input-group-prepend filtro">
            <select class="form-control searchFilter">
                <option value="1">Nombre Colegio</option>
                <option value="2">Código Modular</option>
                <option value="3">Código Local</option>
            </select>
        </div>

        <input type="text" class="form-control searchInput" />

        
        
        <div class="input-group-append btnFiltro">
            <button class="btn btn-success searchCollege" type="button">Buscar</button>
            <button class="btn btn-danger deleteResultSeacrh" type="button" title="Eliminar Busqueda" {{ !isset($route->id) ? 'disabled' : '' }}>
                <i class="fas fa-times"></i>
            </button>
        </div>

        @error('idCollege')
            <small class="text-danger">
                <strong>{{ $message }}</strong>
            </small>   
        @enderror
    </div>
</div>
    

<div class="form-group">
    {!! Form::label('idCollege', 'Lista Colegios (Provincia - Distrito - Centro Poblado - Centro Educativo)') !!}
    <select class="form-control selectResultCopy" disabled>
        <option>Seleccione Colegio...</option>
    </select>
 
    {!! Form::select('idCollege', $colleges, null, ['class' => 'form-control selectResult ', 'placeholder' => 'Seleccione Colegio...', 'style' => 'width:100%;' ]) !!}
    
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