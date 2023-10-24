@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Sponsorizzazioni</h1>
        <div class="row mt-5">
            @foreach ($sponsors as $sponsor)
                <div class="col-md-4">
                    <div
                        class="card @if ($sponsor->name == 'Silver') bg-body-secondary @elseif ($sponsor->name == 'Gold') bg-warning @elseif ($sponsor->name == 'Platinum') bg-body-tertiary @endif">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4>{{ $sponsor->name }}</h4>
                            </div>
                            <div class="card-text">{{ $sponsor->type }}</div>
                            <div class="card-text my-2"><span class="fs-5 text text-secondary-emphasis">Prezzo:</span> €
                                {{ $sponsor->cost }}
                            </div>
                            <div class="text-center">
                                <a href="{{ route('payments.show', ['type' => $sponsor, 'doctor' => $doctor]) }}"
                                    class="btn btn-success">Attiva
                                    Sponsor</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
