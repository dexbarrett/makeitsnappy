<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    {{ HTML::style('/css/main.css') }}
</head>

<body>
    <div id="container">
        <div id="header">
            {{ HTML::link('/', 'Make It Snappy Q&A') }}

            <div id="searchbar">
                {{ Form::open('search', 'POST') }}

                {{ Form::token() }}

                {{ Form::text('keyword') }}
                {{ Form::submit('buscar') }}

                {{ Form::close() }}
            </div><!-- end searchbar -->
        </div><!-- end header -->

        <div id="nav">
            <ul>
                <li>{{ HTML::link_to_route('home', 'Inicio') }}</li>
                @if(Auth::guest())
                <li>{{ HTML::link_to_route('register', 'Registro') }}</li>
                <li>{{ HTML::link_to_route('login', 'Iniciar sesión') }}</li>
                @else
                    <li>{{ HTML::link_to_route('your_questions', 'Tus preguntas') }}</li>
                    <li>{{ HTML::link_to_route('logout', 'Salir (' . Auth::user()->username . ')') }}</li>
                @endif
            </ul>
        </div><!-- end nav -->

        <div id="content">
            @if(Session::has('message'))  
                <p id="message">{{ Session::get('message') }}</p>
            @endif

            @yield('content')
        </div><!-- end content -->

        <div id="footer">
            &copy; Make it Snappy Q&A {{ date('Y') }}
        </div><!-- end footer -->

    </div><!-- end container -->
</body>
</html>    