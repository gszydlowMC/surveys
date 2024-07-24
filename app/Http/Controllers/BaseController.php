<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    /**
     * @param bool $isSuccess
     * @param string $successMessage
     * @param string $errorMessage
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function handleSaveResponse(bool $isSuccess = true, string $successMessage = 'Zapis formularza wykonany pomyślnie.', string $errorMessage = 'Błąd zapisu forularza.', $redirect = '')
    {
        if ($isSuccess) {
            if (\request()->ajax()) {
                return response()->json(['message' => $successMessage, 'redirect' => $redirect]);
            }
            if ($redirect != '') {
                return redirect($redirect)->with('success', $successMessage);
            }
            return back()->with('success', $successMessage);
        } else {
            if (\request()->ajax()) {
                return response()->json(['message' => $errorMessage, 'redirect' => $redirect], 500);
            }
            if ($redirect != '') {
                return redirect($redirect)->with('error', $errorMessage);
            }
            return back()->withInput()->with('error', $errorMessage);
        }
    }
}
