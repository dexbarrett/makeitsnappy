<?php

class User extends Basemodel
{
    public static $rules = array(
        'username'              => 'required|unique:users|alpha_dash|min:4',
        'password'              => 'required|alpha_num|confirmed|between:4,10',
        'password_confirmation' => 'required|alpha_num|between:4,10'
    );


    public function questions()
    {
        return $this->has_many('Question');
    }

    public function answers()
    {
        return $this->has_many('Answer');
    }
} 