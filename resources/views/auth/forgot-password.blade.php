@extends('_partials.layouts.auth')
@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-xxl-3 col-md-2 col-12"></div>
            <div class="col-xxl-6 col-md-8 mx-auto">
                <div class="row">
                    <div class="col-9 mx-auto mt-5">
                        <div class="forgot-box white-box mt-5">
                            <h2 class="text-center mt-3">Zapomniałeś hasło?</h2>
                            <p class="py-2">
                                Wprowadź swój adres e-mail, a my wyślemy Ci link do resetowania hasła
                            </p>
                            <div class="login-box text-left">
                                <!-- Forgot Password Form -->
                                <form method="POST" action="{{ route('auth.forgot.store') }}" class="auth-form">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="form-group mt-4">
                                        <label class="form-label" for="email">Adres Email</label>
                                        <input id="email" class="form-control" type="email" name="email"
                                               placeholder="Wpisz adres Email"/>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group mt-4 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Wyślij') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-2 col-12"></div>
        </div>
    </div>
@endsection
@include('_partials.session_messages')
