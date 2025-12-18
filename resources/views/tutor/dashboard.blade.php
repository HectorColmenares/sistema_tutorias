@extends('layouts.tutor')
@section('title', 'Inicio')

@section('content')
<div class="page-wrap">
    <h2>Dashboard Tutor</h2>
    <p>Bienvenido, {{ auth()->user()->name }}</p>
</div>
@endsection
