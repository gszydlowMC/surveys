<?php

use App\Http\Controllers\Admin\ImportSubscriberController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\SurveyEmailController;
use App\Http\Controllers\Admin\SurveySendController;
use App\Http\Controllers\Admin\SurveySmsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])
    ->name('login');

Route::get('login', [AuthController::class, 'login'])
    ->name('login');

Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
//    Route::resource('questions', QuestionController::class);
    Route::resource('surveys', SurveyController::class);
    Route::group(['prefix' => 'surveys/{survey}/', 'as' => 'surveys.'], function () {
        Route::resource('send', SurveySendController::class)->only('create', 'store');
    });
    Route::resource('survey_emails', SurveyEmailController::class);
    Route::resource('survey_sms', SurveySmsController::class);
    Route::resource('users', UserController::class);
    Route::resource('subscribers', SubscriberController::class);
    Route::resource('subscriber_import', ImportSubscriberController::class);

});


Route::middleware('guest')->prefix('/auth/')->name('auth.')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginStore'])->name('login.store');

    Route::get('forgot', [AuthController::class, 'forgotPassword'])->name('forgot');
    Route::post('forgot', [AuthController::class, 'forgotPasswordStore'])->name('forgot.store');

    Route::get('reset/{token}', [AuthController::class, 'resetPassword'])->name('reset');
    Route::post('reset', [AuthController::class, 'resetPasswordStore'])->name('reset.store');

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function(){

    })->name('dashboard');
    Route::resource('/profile', ProfileController::class)->only(['index', 'store']);
    Route::get('logout', [AuthController::class, 'logout'])
        ->name('logout');
});
