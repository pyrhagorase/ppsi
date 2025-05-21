<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return match (auth::user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'user' => redirect()->route('user.homepage'),
                default => abort(403)
            };
        }
        return back()->with('error', 'Email atau password salah');
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
