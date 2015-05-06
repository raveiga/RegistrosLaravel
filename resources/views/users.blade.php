@extends('layouts.master')

@section('titulo')
	Usuarios de la Aplicación 
@stop

@section('contenido')
	<!-- Comprobamos si el usuario está conectado
	y mostramos su username y un enlace para desconectarse 
	-->
	@if (Auth::check())
		Usuario Actual: {{Auth::user()->username}}. {!! Html::link('logout','Desconectar')  !!}
	@endif

	<h1>Listado de todos los usuarios</h1>
	@foreach($users as $usuario)
	<p><a href='/users/{{$usuario->id}}'>{{$usuario->username}}</a></p>
	@endforeach

	<br/><a href='/users/create'>Dar de Alta Usuario</a>
@stop