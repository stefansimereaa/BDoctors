@extends('layouts.app')
@section('content')
    <div class="container home d-flex">
        <div class="home-container d-flex">
            <img src="{{ asset('medicinelogo.png') }}" alt="logo">
            <div>
                <h1>Benvenuto nell'applicazione n1 per i dottori</h1>
                <h3>mostrati ai nostri utenti,organizza prenotazioni con una messaggistica diretta</h3>
                <p>ricevi recensioni feedback e tanto altro</p>
            </div>
        </div>
    </div>
@endsection
