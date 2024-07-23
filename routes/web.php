<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->prefix('/auth/')->name('auth.')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginStore'])->name('login.store');

    Route::get('forgot', [AuthController::class, 'forgotPassword'])->name('forgot');
    Route::post('forgot', [AuthController::class, 'forgotPasswordStore'])->name('forgot.store');

    Route::get('reset/{token}', [AuthController::class, 'resetPassword'])->name('reset');
    Route::post('reset', [AuthController::class, 'resetPasswordStore'])->name('reset.store');

});

Route::get('/login', function () {
    return redirect()->route('auth.login');
})->name('login');

Route::get('/', function () {
    if (Auth::user()->id ?? false) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('auth.login');
    }
});

Route::middleware('auth')->group(function () {


    Route::get('logout', [AuthController::class, 'logout'])
        ->name('logout');
});


Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
//Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
//    Route::resource('questions', QuestionController::class);
    Route::resource('surveys', SurveyController::class);
});
