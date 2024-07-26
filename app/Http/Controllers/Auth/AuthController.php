<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\ForgotRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        Auth()->user()->fill(['last_login' => now()->format('Y-m-d H:i:s')])->save();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(RegisterRequest $request)
    {

    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
//        return view('emails.forgot_password');
    }

    public function forgotPasswordStore(ForgotRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], []);

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                ? back()->with('success', __('Pomyślnie wysłano link do resetu hasła.'))
                : back()->withInput($request->only('email'))
                    ->with(['error' => __('Nie udało się wysłać linku do resetu hasła.')]);
        } catch (\Exception $e) {
            return back()->withInput($request->only('email'))
                ->with(['error' => __('Nie udało się wysłać linku do resetu hasła.')]);
        }
    }


    public function resetPassword($token)
    {
        return view('auth.reset-password');
    }

    public function resetPasswordStore(ResetRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('success', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
