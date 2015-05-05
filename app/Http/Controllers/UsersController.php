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
		// Mostramos la información del usuario
		// Comprobamos si existe ese usuario
		$usuario = User::find($id);

		if ($usuario == null)
		{
			return Redirect::to('users');
		}

		return view('perfil')->withElusuario($usuario);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Comprobamos si el id es correcto.
		$usuario = User::find($id);

		if ($usuario == null)
		{
				return Redirect::to('users');
		}

		return view('editar')->withId($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		// Reglas de validación.
		$reglas = array(
			'username'=>'unique:users',
			'email'=>'email|unique:users',
			'password'=>'min:6'
			);

		$validacion=Validator::make($request->all(),$reglas);

		if ($validacion->fails())
		{
			return Redirect::to('users/'.$id.'/edit')
				->withInput()
				->withErrors($validacion->messages());
		}

		// Buscamos el usuario a editar.
		$usuario = User::find($id);

		if ($request->input('username')) // Si recibimos un username
			$usuario->username=$request->input('username');
		if ($request->input('email')) // Si recibimos un email
			$usuario->email=$request->input('email');			
		if ($request->input('bio')) // Si recibimos un bio
			$usuario->bio=$request->input('bio');
		if ($request->input('password')) // Si recibimos un password
			$usuario->password=Hash::make($request->input('password'));

		// Grabamos los datos actualizados del usuario
		$usuario->save();

		// Volvemos a la página personal del usuario
		return Redirect::to('users/'.$id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Buscamos el usuario.
		$usuario = User::find($id);
		if ($usuario !=null)
		{
			$usuario->delete();
		}

		return Redirect::to('users');

	}

}
