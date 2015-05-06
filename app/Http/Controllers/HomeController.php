<?php namespace App\Http\Controllers;

use Redirect;
use Auth;
use Request;

class HomeController extends Controller {

	public function getIndex()
	{
		//return view('home');
		return Redirect::to('users');
	}

	public function getLogin()
	{
		// Nos vamos a autenticar con un usuario por defecto a modo de prueba
		// $credenciales=array('username'=>'usuario','password'=>'abc123.');

		// Para validar la autenticación tenemos dos formas:
		// Auth::validate()  -> Nos valida pero no nos loguea en la aplicación.
		// Auth::attempt() ->  Nos valida y loguea en la aplicación.
		/*
		if (Auth::attempt($credenciales,true))
			return Redirect::to('users');

		return "Acceso denegado.";
		*/

		return view('login');
	}

	public function postLogin()
	{
		$credenciales=array(
			'username'=>Request::input('username'),
			'password'=>Request::input('password')
		);

		if (Auth::attempt($credenciales))
		{
			return Redirect::to('users');
		}
		else
			return Redirect::to('login')->withInput();
	}


	public function getLogout()
	{
		// Para desconectarnos...
		Auth::logout();
		return Redirect::to('users');
	}

}
