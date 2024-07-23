@extends('layouts.center')
@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-xxl-3 col-md-2 col-12"></div>
            <div class="col-xxl-6 col-md-8 mx-auto">
                <div class="row">
                    <div class="col-8 mx-auto">
                        <div class="register-box">
                            <h3 class="text-center my-3">Logowanie</h3>

                            <form method="POST" action="{{ route('auth.login.store') }}" class="auth-form">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="email">Login</label>
                                    <input type="email" id="email"  name="email" placeholder="Wpisz login" class="form-control"/>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="password">Hasło</label>
                                    <input id="password" class="form-control" type="password" name="password" placeholder="Wpisz hasło"/>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <p class="text-right">
                                        <a class="text-type-2"
                                           href="{{ route('auth.forgot') }}">
                                            {{ __('Przypomnij hasło') }}
                                        </a>
                                    </p>
                                </div>

                                <div class="form-group mt-4 text-center">
                                    <button type="submit" class="button-main">
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
@include('partials.session_messages')
