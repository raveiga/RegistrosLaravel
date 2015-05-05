@extends('layouts.master')

@section('titulo')
Edición de mi perfil
@stop

@section('contenido')

@foreach ($errors->all() as $error)
	<p> {{$error}} </p>
@endforeach


<form method="post" action="/users/{{$id}}" novalidate>
	<p><label for="username">Nuevo usuario:<input type="text" name="username" value=""/></label></p>

	<p><label for="email">Nuevo E-mail:<input type="email" name="email" value=""/></label></p>

	<p><label for="bio">Nueva Biografía:<textarea name="bio"></textarea></label></p>

	<p><label for="password">Nueva contraseña:<input type="password" name="password" value=""/></label></p>

	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	<input type="hidden" name="_method" value="PATCH"/>
	<button>Actualizar Datos</button>
</form>

<hr/>

{!! Form::open(array('url'=>'users/'.$id, 'method'=>'DELETE'))  !!}
{!! Form::submit('Borrar mi Perfil')  !!}
{!! Form::close() !!}

<br/><a href="/users/{{$id}}">Volver</a>
@stop