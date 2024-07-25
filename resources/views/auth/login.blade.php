@extends('_partials.layouts.auth')
@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-xxl-3 col-md-2 col-12"></div>
            <div class="col-xxl-6 col-md-8 mx-auto">
                <div class="row">
                    <div class="col-9 mx-auto mt-5">
                        <div class="register-box white-box mt-5">
                            <h2 class="text-left my-3">Logowanie</h2>

                            <form method="POST" action="{{ route('auth.login.store') }}" class="auth-form">
                                @csrf
                                <div class="form-group mt-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Wpisz adres e-mail"
                                           class="form-control"/>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="password">Hasło</label>
                                    <input id="password" class="form-control" type="password" name="password"
                                           placeholder="Wpisz hasło"/>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <p class="text-left mt-2">
                                        <a class="auth-link"
                                           href="{{ route('auth.forgot') }}">
                                            {{ __('Zapomniałeś hasło?') }}
                                        </a>
                                    </p>
                                </div>

                                <div class="form-group mt-4 text-center mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Zaloguj się') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-2 col-12"></div>
        </div>
    </div>
@endsection
@include('_partials.session_messages')
