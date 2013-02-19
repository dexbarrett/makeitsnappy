<?php

class Users_Controller extends Base_Controller
{
    public $restful = true;


    public function get_new()
    {
        return View::make('users.new')
            ->with('title', 'Make It Snappy Q&A - Register');
    }


    public function post_create()
    {

        $validation = User::validate(Input::all());

        if ($validation->fails()) {
            return Redirect::to_route('register')
                   ->with_errors($validation)
                   ->with_input(); 
        }


        /* Si la validación pasa entonces se continúa en este bloque */

        User::create(array(
            'username' => Input::get('username'),
            'password' => Hash::make(Input::get('password'))
        ));

        /* iniciar sesión automáticamente después de que se registra al usuario */

        $user = User::where_username(Input::get('username'))->first();
        Auth::login($user);

        return Redirect::to_route('home')
               ->with('message', 'Gracias por registrarse!');


    }



    public function get_login()
    {
        if (Auth::check()) {
            return Redirect::to_route('home');
        }

        return View::make('users.login')
               ->with('title', 'Make It Snappy Q&A - Login');
    }



    public function post_login()
    {

        $user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($user)) {
            return Redirect::to_route('home')
                   ->with('message', 'Has iniciado sesión');
        } 
            

        return Redirect::to_route('login')
               ->with('message', 'los datos de inicio de sesión son incorrectos')
               ->with_input();
        

    }


    public function get_logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return Redirect::to_route('login')
                   ->with('message', 'Has cerrado sesión');
        }

        return Redirect::to_route('home');
    }


}