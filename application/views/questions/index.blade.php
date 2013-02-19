@layout('layouts.default')

@section('content')
<div id="ask">
    <h1>Hacer una nueva pregunta</h1>

    @if(Auth::check())
        @if($errors->has())
            <p>Han ocurrido los siguientes errores</p>

            <ul id="form-errors">
                {{ $errors->first('question', '<li>:message</li>') }}
            </ul>
        @endif

        {{ Form::open('ask', 'POST') }}

        {{ Form::token() }}

        <p>
            {{ Form::label('question', 'Pregunta') }}<br/>
            {{ Form::text('question', Input::old('question')) }}

            {{ Form::submit('Publicar pregunta') }}
        </p>

        {{ Form::close() }}
    @else
         <p>Hay que iniciar sesión antes de poder publicar una pregunta</p>   
    @endif
</div><!-- end ask -->
<div id="questions">
    <h2>Preguntas sin resolver</h2>

    @if(!$questions->results)
        <p>No hay preguntas</p>
    @else
        <ul>
            @foreach($questions->results as $question)
                <li>
                    {{ HTML::link_to_route('question',Str::limit($question->question, 35), $question->id) }} 
                    by {{ ucfirst($question->user->username) }}
                    ({{ count($question->answers) }} {{ Str::plural('respuesta', count($question->answers)) }})
                </li>
            @endforeach
        </ul>
        {{ $questions->links() }}
    @endif
</div><!-- end questions -->
@endsection