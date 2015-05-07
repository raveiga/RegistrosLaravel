<?php namespace App\Http\Controllers;

use Redirect;
use Auth;
use Request;

class HomeController extends Controller {

	public function __construct()
	{
		$this->middleware('auth',array('only'=>'getMiembros'));
	}

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

	public function getMiembros()
	{
		return "<h1>Noticias para usuarios registrados</h1><p>Se les comunica la cuenta bancaria para el pago de la cuota mensual: 1234 5678 979 8874.</p><p>Saludos.</p>La Dirección.";
	}

}