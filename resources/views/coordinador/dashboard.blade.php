@extends('layouts.coordinador')

@section('title', 'Dashboard Coordinador')

@section('content')
    <div class="welcome" style="width:100%; max-width: 1100px;">
        <h1>Sistema de Tutorías - Coordinador</h1>


        @auth
            <div class="user-info" style="max-width: 900px;">
                <p><strong>Usuario:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>
        @endauth
    </div>
@endsection
