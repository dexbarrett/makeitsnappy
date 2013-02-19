<?php

class Answers_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'auth')
             ->only(array('create'));
    }

    public function post_create()
    {
        $question_id = Input::get('question_id');
        $validation  = Answer::validate(Input::all());

        if ($validation->fails()) {
            return Redirect::to_route('question', $question_id)
            ->with_errors($validation)
            ->with_input();    
        }

        Answer::create(array(
                'answer'      => Input::get('answer'),
                'user_id'     => Auth::user()->id,
                'question_id' => $question_id
        ));

        return Redirect::to_route('question', $question_id)
               ->with('message', 'Tu respuesta ha sido publicada');
    }
}