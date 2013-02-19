@layout('layouts.default')

@section('content')
    @if(!is_null($question))
    <h1>{{ ucfirst($question->user->username) }}  preguntó:</h1>

    <p>
        {{ e($question->question) }}
    </p> 

    <div id="answer">
        <h2>Respuestas</h2>

        @if(!$question->answers)
            <p>No se han publicado respuestas para esta pregunta</p>
        @else
            <ul>
                @foreach($question->answers as $answer)
                    <li>{{ e($answer->answer) }} - by {{ ucfirst($answer->user->username) }}</li>
                @endforeach
            </ul>
        @endif
    </div><!-- end answer-->

    <div id="post-answer">
        <h2>Responder a esta pregunta</h2>

        @if(Auth::guest())
            <p>Favor de iniciar sesión para publicar una respuesta</p>
        @else
            @if($errors->has())
                <ul id="form-errors">
                    {{ $errors->first('answer', '<li>:message</li>') }}
                </ul>
            @endif

            {{ Form::open('answer', 'POST') }}
            {{ Form::token() }}

            {{ Form::hidden('question_id', $question->id) }}

            <p>
                {{ Form::label('answer', 'Respuesta') }}
                {{ Form::text('answer', Input::old('answer')) }}

                {{ Form::submit('Publicar respuesta') }}
            </p>

            {{ Form::close() }}
        @endif
    </div>
    @else
        <p>No se encontró la pregunta solicitada</p>
    @endif
@endsection