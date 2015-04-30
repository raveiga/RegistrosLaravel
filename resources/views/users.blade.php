@extends('layouts.master')

@section('titulo')
	Usuarios de la Aplicación 
@stop

@section('contenido')
	<h1>Listado de todos los usuarios</h1>
	@foreach($users as $usuario)
	<p>{{$usuario->username}}</p>
	@endforeach
@stop