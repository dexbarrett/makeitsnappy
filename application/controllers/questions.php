 <?php
 class Questions_Controller extends Base_Controller
 {
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'auth')
             ->only(array('create', 'your_questions', 'edit', 'update'));
    }

    public function get_index()
    {
        return View::make('questions.index')
            ->with('title', 'Make It Snappy Q&A - Home')
            ->with('questions', Question::unsolved());
    }


    public function post_create()
    {
        $validation = Question::validate(Input::all());


        if ($validation->fails()) {
            return Redirect::to_route('home')
                   ->with_errors($validation)
                   ->with_input();
        }


        $question = new Question(array(
            'question' => Input::get('question')
        ));

        /* creamos la nueva pregunta utilizando la relación usuario-preguntas */
        Auth::user()->questions()->insert($question);

        return Redirect::to_route('home')
               ->with('message', 'Tu pregunta ha sido publicada');
    }


    public function get_view($id = null)
    {
        return View::make('questions.view')
               ->with('title', 'Make It Snappy - View Question')
               ->with('question', Question::find($id));

    }


    public function get_your_questions()
    {
        return View::make('questions.your_questions')
               ->with('title', 'Make It Snappy Q&A - Your Questions-')
               ->with('username', Auth::user()->username)
               ->with('questions', Question::your_questions());
    }


    public function get_edit($id = null)
    {
        $question = Question::find($id);

        if (is_null($question) or !$this->question_belongs_to_user($id)) {

            return Redirect::to_route('your_questions')
                   ->with('message', 'La pregunta solicitada no es válida'); 
        }


        return View::make('questions.edit')
               ->with('title', 'Make It Snappy Q&A - Editar pregunta')
               ->with('question', $question);  

    }

    public function put_update()
    {
        $id       = Input::get('question_id');
        $question = Question::find($id);

        if (is_null($question) or !$this->question_belongs_to_user($id)) {
            return Redirect::to_route('your_questions')
                   ->with('message', 'La pregunta que desea actualizar no es válida');
        }


        $validation = Question::validate(Input::all());

        if ($validation->fails()) {
            return Redirect::to_route('edit_question', $id)
                   ->with_errors($validation);

        }
        
        $solved = Input::get('solved', 0);

        $question->question = Input::get('question');
        $question->solved   = $solved;
        $question->save();

        return Redirect::to_route('question', $id)
                ->with('message', 'Tu pregunta ha sido actualizada');

    }

    public function get_results($keyword)
    {
        return View::make('questions.results')
                ->with('title', 'Make It Snappy Q&A - Resultados de la búsqueda')
                ->with('questions', Question::search($keyword));
    }

    public function post_search()
    {
        $keyword = Input::get('keyword');

        if (empty($keyword)) {
            return Redirect::to_route('home')
                   ->with('message', 'no se especificó ningún término de búsqueda');
        }

        return Redirect::to('results/' . $keyword);
    }


    private function question_belongs_to_user($id)
    {
        $question = Question::find($id);

        return ($question->user_id == Auth::user()->id);
        
    }

 }