<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        } else {
            return view('auth.login', ['type' => 'user']);
        }
    }

    public function adminLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect('admin/dashboard');
        } else {
            return view('auth.login', ['type' => 'admin']);
        }
    }

    public function actionlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin == 0) {
                return redirect()->intended('home');
            }
            // Jika user adalah admin tapi mencoba login di halaman user
            return redirect()->route('choose.login')
                ->with('error', 'Anda adalah admin, silakan login melalui halaman admin.');
        }

        return redirect()->route('login.user')
            ->with('error', 'Email atau Password salah');
    }

    public function actionAdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin == 1) {
                return redirect()->intended('admin/dashboard');
            }
            // Jika user bukan admin tapi mencoba login di halaman admin
            return redirect()->route('choose.login')
                ->with('error', 'Anda bukan admin, silakan login melalui halaman user.');
        }

        return redirect()->route('login.admin')
            ->with('error', 'Email atau Password salah');
    }

    public function actionlogout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}