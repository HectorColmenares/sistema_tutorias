@extends('layouts.alumno')

@section('title', 'Inicio')

@section('content')
<div class="page-wrap welcome">
    <h2>Dashboard Alumno</h2>
    <p>Bienvenido, {{ auth()->user()->name }} ({{ auth()->user()->rol }})</p>
</div>
@endsection
