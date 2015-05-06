<?php namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class Propietario {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// Id del usuario en la URL
		$id=$request->segment(2);

		// Comprobamos si el usuario logueado coincide con el users/id que tenemos
		// en la ruta.
		if (Auth::user()->id !== (int)$id)
		{
			return Redirect::to('users');
		}

		return $next($request);
	}

}
