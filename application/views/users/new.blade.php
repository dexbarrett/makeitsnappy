@layout('layouts.default')

@section('content')
    <h1>Registro</h1>

    @if($errors->has())
        <p>Han ocurrido los siguientes errores:</p> 

        <ul id="form-errors">
            {{ $errors->first('username', '<li>:message</li>') }}
            {{ $errors->first('password', '<li>:message</li>') }}
            {{ $errors->first('password_confirmation', '<li>:message</li>') }}
        </ul>
    @endif

    {{ Form::open('register', 'POST') }}

    {{ Form::token() }}

    <p>
        {{ Form::label('username', 'Usuario') }}<br/>
        {{ Form::text('username', Input::old('username')) }}
    </p>

    <p>
        {{ Form::label('password', 'Password') }}<br/>
        {{ Form::password('password') }}
    </p>

    <p>
        {{ Form::label('password_confirmation', 'Confirmar Password') }}<br/>
        {{ Form::password('password_confirmation') }}
    </p>

    <p>
        {{ Form::submit('Registrar') }}
    </p>

    {{ Form::close() }}
@endsection