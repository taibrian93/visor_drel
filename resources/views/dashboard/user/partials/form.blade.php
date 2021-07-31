<div class="form-group">
    {!! Form::label('name', 'Nombre ') !!}
    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) !!}
    @error('name')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('email', 'Email ') !!}
    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) !!}
    @error('email')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('password', 'Password ') !!}
    {!! Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : '' ) ) ) !!}
    @error('password')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>