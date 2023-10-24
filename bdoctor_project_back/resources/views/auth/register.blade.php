@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form id="registration-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}*</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    {{-- Error field  --}}
                                    <div id="name-errorField" class="d-none"></div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}*</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                    {{-- Error field  --}}
                                    <div id="last-name-errorField" class="d-none"></div>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}*</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Specializzazioni') }}*</label>

                                <div class="col-md-6">
                                    <div class="row">
                                        @foreach ($specializations as $specialization)
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input specializations @error('specialization') is-invalid @enderror"
                                                        type="checkbox"
                                                        value="{{ old('specializations[]', $specialization->id) }}"
                                                        id="{{ $specialization->name }}" name="specialization[]"
                                                        {{ is_array(old('specialization')) && in_array($specialization->id, old('specialization')) ? ' checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $specialization->name }}">
                                                        {{ ucfirst($specialization->name) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- Error field  --}}
                                        <div id="spec-errorField" class="d-none"></div>
                                        @if ($errors->has('specialization'))
                                            <span class="text-danger fs-6">
                                                <strong>{{ $errors->first('specialization') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-Mail') }}*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    {{-- Error field  --}}
                                    <div id="email-errorField" class="d-none"></div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}*</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    {{-- Error field  --}}
                                    <div id="psw-errorField" class="d-none"></div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}*</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                    {{-- Error field  --}}
                                    <div id="confirmPsw-errorField" class="d-none"></div>
                                </div>

                            </div>
                            <div class="mb-4 row">
                                <label for="mandatory" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-md-6">
                                    <span>I campi marcati con asterisco (*) sono obbligatori</span>
                                </div>
                            </div>
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    @vite('resources/js/validations/register-validation.js')
</script>
