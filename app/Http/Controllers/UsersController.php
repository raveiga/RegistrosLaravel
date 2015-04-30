<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// Utilizamos el modelo User.
use App\User;

// Usamos Validator.
use Validator;
use Redirect;
use Hash;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//return "hola usuario";
		return View('users')->withUsers(User::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// Definimos reglas de validación.
		$reglas=array(
			'username'=>'required|unique:users',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
			'password-repeat' => 'required|same:password'
			);

		// Procedemos a validar el formulario con Validator.
		$validator=Validator::make($request->all(),$reglas);

		// Comprobamos si hay fallos en la validación
		if ($validator->fails())
		{
			return Redirect::to('users/create')
			->withInput()
			->withErrors($validator->messages());
		}

		// Si no hay fallos de validación
		// Grabamos los datos en la tabla users.
		User::create(array(
			'username'=>$request->input('username'),
			'email'=>$request->input('email'),
			'password'=>Hash::make($request->input('password')),
			'bio'=>$request->input('bio')
			));

		// redireccionamos a Users.
		return Redirect::to('users');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
