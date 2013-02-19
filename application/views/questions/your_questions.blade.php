@layout('layouts.default')

@section('content')
    <h1>Tus preguntas</h1>

    @if(!$questions->results)
        <p>No has publicado ninguna pregunta.</p>
    @else
        <ul>
            @foreach($questions->results as $question)
                <li>
                    {{ Str::limit(e($question->question), 40) }} -
                    {{ ($question->solved) ? '(respondida)' : '' }}
                    {{ HTML::link_to_route('edit_question', 'editar', $question->id) }} -
                    {{ HTML::link_to_route('question', 'Ver pregunta', $question->id) }}
                </li>
            @endforeach
        </ul>

        {{ $questions->links() }}
    @endif
@endsection  