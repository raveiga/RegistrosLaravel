<?php namespace App\Http\Middleware;

use Closure;
use App\User;
use Redirect;

class Existe {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// Comprobamos si el usuario existe.
		$id=$request->segment(2);
		$usuario= User::find($id);

		// Si no existe el usuario...
		if ($usuario ==null)
			return Redirect::to('users');

		// Si existe el usuario...
		return $next($request);
	}

}
