@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if ($doctor->id == $user_id)
            <div class="row align-items-center d-flex">
                {{-- Foto profilo --}}
                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body d-flex align-items-center">
                            <img src="{{ $doctor->profile_photo ?? url('/user_placeholder.jpg') }}" class="card-img-top"
                                alt="Doctor's Photo">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card border-0">
                        <a href="{{ route('payments.index') }}">
                            {{-- Sponsor image --}}
                            <img src="{{ asset('sponsor.png') }}" alt="sponsor image"
                                class="card-img-top w-100 rounded mb-3">
                        </a>
                    </div>
                </div>


                <div class="col-md-8 doc-info">

                    {{-- Nome, cognome e descrizione --}}
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title">Doctor {{ $doctor->user->name }} {{ $doctor->user->last_name }}</h5>
                            <p class="card-text">{{ $doctor->description }}</p>
                        </div>
                    </div>

                    {{-- Telefono, indirizzo e prestazioni --}}
                    <div class="card my-3">
                        <h5 class="card-title m-2">Informazioni Personali</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item half">Phone: {{ $doctor->phone_number }}</li>
                            <li class="list-group-item half">Address: {{ $doctor->address }}</li>
                            <li class="list-group-item">Performances: {{ $doctor->performances }}</li>
                        </ul>
                    </div>

                    {{-- Specializzazioni --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Specializzazioni</h5>
                            @foreach ($doctor->specializations as $specialization)
                                <p>{{ $specialization->name }}</p>
                            @endforeach
                        </div>
                    </div>

                    {{-- Curriculum --}}
                    @if ($doctor->cv)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Curriculum Vitae</h5>
                                <a href="{{ $doctor->cv }}" target="_blank">Visualizza cv</a>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end mt-3">

                        {{-- Pulsante di modifica --}}
                        <a class="btn mx-2 mb-3" href="{{ route('admin.doctor.edit', $doctor) }}">Modifica</a>
                    </div>
                </div>
            </div>
        @else
            <h1>Not found</h1>
        @endif
    </div>
@endsection
