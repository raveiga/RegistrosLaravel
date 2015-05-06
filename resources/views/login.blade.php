@extends('layouts.master')

@section('titulo')
Login
@stop

@section('contenido')

@if(Input::old())
	Error: datos de acceso incorrectos.
@endif

{!! Form::open(array('url'=>'login')) !!}

<p>
{!! Form::label('username','Usuario:') !!}
{!! Form::text('username') !!}
</p>

<p>
{!! Form::label('password','Contraseña:') !!}
{!! Form::password('password') !!}
</p>

<p>{!! Form::submit('Acceder') !!}</p>

{!! Form::close() !!}
@stop