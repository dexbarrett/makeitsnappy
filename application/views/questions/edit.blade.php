@layout('layouts.default')

@section('content')
    <h1>Editar pregunta</h1>

    @if($errors->has())
        <ul id="form-errors">
            {{ $errors->first('question', '<li>:message</li>') }}
            {{ $errors->first('solved', '<li>:message</li>') }}
        </ul>
    @endif

    {{ Form::open('question/update', 'PUT') }}
    {{ Form::token() }}

    <p>
        {{ Form::label('question', 'Pregunta') }}<br/>
        {{ Form::text('question', $question->question) }}
    </p>

    <p>

        {{ Form::label('solved', 'respondida') }}  
        {{ Form::checkbox('solved', 1, $question->solved) }}
        
    </p>

    {{ Form::hidden('question_id', $question->id) }}

    {{ Form::submit('Guardar cambios') }}

    {{ Form::close() }}
@endsection