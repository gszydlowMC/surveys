@extends('partials.layouts.center')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xxl-4 col-md-6 col-sm-12 mx-auto">
                <h2 class="text-center my-5">Reset / Ustawienie Hasła</h2>
                <div class="login-box text-left">
                    <form method="POST" action="{{ route('auth.reset.store') }}" class="auth-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        {{-- Email Address --}}
                        <div class="form-group">
                            <label for="email" class="input-label">Email</label>
                            <input id="email" type="email" class="block mt-1 w-full form-control" name="email"
                                   value="{{ request()->email ?? old('email') }}" autofocus autocomplete="email"
                                   placeholder="Wprowadź email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group mt-4">
                            <label for="password" class="input-label">Hasło</label>
                            <input id="password" type="password" class="block mt-1 w-full form-control" name="password"

                                   autocomplete="new-password" placeholder="Wprowadź hasło">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <label for="password_confirmation" class="input-label">Powtórz hasło</label>
                            <input id="password_confirmation" type="password" class="block mt-1 w-full form-control"
                                   name="password_confirmation" autocomplete="new-password"
                                   placeholder="Potwierdź hasło">
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4 text-center">
                            <p>
                                <a href="{{ route('auth.login') }}" class="text-type">
                                    Zaloguj się
                                </a></p>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn button-main">
                                    Wyślij
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.partials.session_messages')
