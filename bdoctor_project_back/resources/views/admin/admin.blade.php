@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="dash-stryl">
            <h2 class="fs-4 text-secondary my-4">
                {{ __('Dashboard') }}
            </h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="row g-0 m-4">
                            <div class="col-md-4">
                                {{-- Profile photo dashboard --}}
                                <img src="{{ $doctor->profile_photo ?? url('/user_placeholder.jpg') }}"class="card-img-top w-100"
                                    alt="Doctor's Photo">
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title">Dr. {{ $doctor->user->name }} {{ $doctor->user->last_name }}</h5>
                                    <p class="card-text"> Specializzazioni:</p>
                                    <ul class="list-unstyled">
                                        @foreach ($doctor->specializations as $specialization)
                                            <li>{{ $specialization->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mt-4">
                                    <hr>
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <ul class="list-inline text-center">
                                                <li class="list-inline-item"><a href="#messaggi"
                                                        class="btn btn-primary rounded-2">Messaggi</a></li>
                                                <li class="list-inline-item"><a href="#recensioni"
                                                        class="btn btn-primary rounded-2">Recensioni</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="row g-0 m-4">
                            <div class="row">
                                <!-- Col per i Messaggi -->
                                <div class="col" id="messaggi">
                                    <h5>Ultimi messaggi ricevuti</h5>
                                    <!-- Messages Accordions -->
                                    <div id="message-accordion">
                                        @foreach ($messages as $message)
                                            @if ($message->doctor_id === $doctor->id)
                                                <div class="card mb-4">
                                                    <div class="card-header" id="message-heading{{ $message->id }}">
                                                        <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                            <span>Nome: {{ $message->name }}
                                                                {{ $message->last_name }}</span>
                                                            <button class="btn btn-primary rounded-3" data-toggle="collapse"
                                                                data-target="#message-collapse{{ $message->id }}">
                                                                Mostra di più
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="message-collapse{{ $message->id }}" class="collapse"
                                                        aria-labelledby="message-heading{{ $message->id }}"
                                                        data-parent="#message-accordion">
                                                        <div class="card-body">
                                                            <p><strong>Email: </strong>{{ $message->email }}</p>
                                                            <p><strong>Contenuto: </strong>{{ $message->text }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="row g-0 m-4">
                            <div class="row">
                                <!-- Col per le Recensioni -->
                                <div class="col" id="recensioni">
                                    <h5>Ultime recensioni ricevuti</h5>
                                    <!-- Recensioni Accordions -->
                                    <div class="mb-4">
                                        <div id="review-accordion">
                                            @foreach ($reviews as $review)
                                                @if ($review->doctor_id === $doctor->id)
                                                    <div class="card mb-4">
                                                        <div class="card-header" id="review-heading{{ $review->id }}">
                                                            <h5
                                                                class="mb-0 d-flex justify-content-between align-items-center">
                                                                <span>Nome: {{ $review->name }}</span>
                                                                <button class="btn btn-primary rounded-3"
                                                                    data-toggle="collapse"
                                                                    data-target="#review-collapse{{ $review->id }}">
                                                                    Mostra di più
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="review-collapse{{ $review->id }}" class="collapse"
                                                            aria-labelledby="review-heading{{ $review->id }}"
                                                            data-parent="#review-accordion">
                                                            <div class="card-body">
                                                                <p><strong>Email: </strong>{{ $review->email }}</p>
                                                                <p><strong>Contenuto: </strong>{{ $review->text }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <!-- Col per la sponsor -->
                    <a href="{{ route('payments.index') }}">
                        {{-- Sponsor image --}}
                        <img src="{{ asset('sponsor.png') }}" alt="sponsor image" class="card-img-top w-100 rounded mb-3">
                    </a>
                    <!-- GRAFICO MESSAGGI -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistiche messaggi ricevuti</h5>
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- GRAFICO VOTI --}}
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title">Statistiche voti ricevuti</h5>
                            <div>
                                <canvas id="ratingsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<script type="module">
    const messages = @json($messages);

    const messagesNov = @json($messagesNov2022);
    const messagesDec = @json($messagesDic2022);
    const messagesGen = @json($messagesGen2023);
    const messagesFeb = @json($messagesFeb2023);
    const messagesMar = @json($messagesMar2023);
    const messagesApr = @json($messagesApr2023);
    const messagesMag = @json($messagesMag2023);
    const messagesGiu = @json($messagesGiu2023);
    const messagesLug = @json($messagesLug2023);
    const messagesAug = @json($messagesAug2023);
    const messagesSet = @json($messagesSet2023);
    const messagesOtt = @json($messagesOtt2023);

    const reviewsNov = @json($reviewsNov2022);
    const reviewsDec = @json($reviewsDic2022);
    const reviewsGen = @json($reviewsGen2023);
    const reviewsFeb = @json($reviewsFeb2023);
    const reviewsMar = @json($reviewsMar2023);
    const reviewsApr = @json($reviewsApr2023);
    const reviewsMag = @json($reviewsMag2023);
    const reviewsGiu = @json($reviewsGiu2023);
    const reviewsLug = @json($reviewsLug2023);
    const reviewsAug = @json($reviewsAug2023);
    const reviewsSet = @json($reviewsSet2023);
    const reviewsOtt = @json($reviewsOtt2023);




    const ctx = document.getElementById('myChart');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Nov', 'Dec', 'Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Aug', 'Set', 'Ott'],
            datasets: [{
                    label: '# of Messages',
                    data: [messagesNov.length, messagesDec.length, messagesGen.length, messagesFeb.length,
                        messagesMar.length, messagesApr.length,
                        messagesMag.length, messagesGiu.length, messagesLug.length, messagesAug.length,
                        messagesSet.length, messagesOtt.length
                    ],
                    borderWidth: 1
                },
                {
                    label: '# of Reviews',
                    data: [reviewsNov.length, reviewsDec.length, reviewsGen.length, reviewsFeb.length,
                        reviewsMar.length, reviewsApr.length,
                        reviewsMag.length, reviewsGiu.length, reviewsLug.length, reviewsAug.length,
                        reviewsSet.length, reviewsOtt.length
                    ],
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script type="module">
    const ratings = @json($ratings);

    const ratingsGen = @json($ratingsGen2023);
    const ratingsFeb = @json($ratingsFeb2023);
    const ratingsMar = @json($ratingsMar2023);
    const ratingsApr = @json($ratingsApr2023);
    const ratingsMag = @json($ratingsMag2023);
    const ratingsGiu = @json($ratingsGiu2023);
    const ratingsLug = @json($ratingsLug2023);
    const ratingsAug = @json($ratingsAug2023);
    const ratingsSet = @json($ratingsSet2023);
    const ratingsOtt = @json($ratingsOtt2023);
    const ratingsNov = @json($ratingsNov2022);
    const ratingsDic = @json($ratingsDic2022);




    const ctx = document.getElementById('ratingsChart');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Nov', 'Dic', 'Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Aug', 'Set', 'Ott'],
            datasets: [{
                label: '# of Ratings',
                data: [ratingsNov.length, ratingsDic.length, ratingsGen.length, ratingsFeb.length,
                    ratingsMar.length, ratingsApr.length,
                    ratingsMag.length, ratingsGiu.length, ratingsLug.length, ratingsAug.length,
                    ratingsSet.length, ratingsOtt.length
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
