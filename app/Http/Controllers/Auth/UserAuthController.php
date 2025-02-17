<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'mail o contraseña incorrectas']);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
