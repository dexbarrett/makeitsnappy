@layout('layouts.default')

@section('content')
    <h1>Inicio de sesión</h1>

    {{ Form::open('login', 'POST') }}
    {{ Form::token() }}

    <p>
        {{ Form::label('username', 'Usuario') }}<br/>
        {{ Form::text('username', Input::old('username')) }}
    </p>

     <p>
        {{ Form::label('password', 'Password') }}<br/> 
        {{ Form::password('password') }}
    </p>

    <p>{{ Form::submit('Iniciar Sesión') }}</p>

    {{  Form::close() }}
@endsection