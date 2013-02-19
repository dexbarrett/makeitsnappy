@layout('layouts.default')

@section('content')
    <h1>Resultados de la búsqueda</h1>

    @if(!$questions->results)
        <p>No se encontraron resultados para la búsqueda</p>
    @else
        <ul>
            @foreach($questions->results as $question)
            <li>
                {{ HTML::link_to_route('question', $question->question, $question->id) }}
                by {{ ucfirst($question->user->username) }}
            </li>
            @endforeach
        </ul>

        {{ $questions->links() }}
    @endif
@endsection