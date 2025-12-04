<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class VerificationCodeController extends Controller
{
    // 1. Show the code entry form
    public function show()
    {
        return view('auth.verify-code'); // You need to create this Blade view
    }

    // 2. Handle the code submission
    public function verify(Request $request)
    {
        $request->validate(['code' => ['required', 'string', 'digits:6']]);

        $user = $request->user();

        if ($request->code === $user->verification_code && now()->lessThan($user->verification_code_expires_at)) {

            $user->markEmailAsVerified();
            $user->verification_code = null;
            $user->verification_code_expires_at = null;
            $user->save();

            return redirect()->intended(route('dashboard', absolute: false));
        }

        throw ValidationException::withMessages([
            'code' => ['The verification code is invalid or has expired.'],
        ]);
    }
}