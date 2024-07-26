<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\ProfilePasswordRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends BaseController
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.password', compact('user'));
    }

    public function store(ProfilePasswordRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->handleSaveResponse(false,'', __('Hasło niepoprawne'), route('profile.index'));
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return $this->handleSaveResponse(true,__('Zmieniono hasło pomyślnie.'), '', route('profile.index'));
    }
}
