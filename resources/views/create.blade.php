@extends('layouts.master')

@section('titulo')
Regístrate
@stop

@section('contenido')

@foreach ($errors->all() as $error)
	<p> {{$error}} </p>
@endforeach


<form method="post" action="/users" novalidate>
	<p><label for="username">Usuario*:<input type="text" name="username" value="{{ Input::old('username') }}"/></label></p>

	<p><label for="email">E-mail*:<input type="email" name="email" value="{{ Input::old('email') }}"/></label></p>

	<p><label for="bio">Biografía:<textarea name="bio">{{ Input::old('bio') }}</textarea></label></p>

	<p><label for="password">Contraseña*:<input type="password" name="password" value="{{ Input::old('password') }}"/></label></p>

	<p><label for="password-repeat">Repita contraseña*:<input type="password" name="password-repeat" value="{{ Input::old('password-repeat') }}"/></label></p>

	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	<button>Submit</button>
</form>

@stop