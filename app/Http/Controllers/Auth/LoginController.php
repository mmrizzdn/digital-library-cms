<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view(
            'auth.login',
            ['title' => 'Digital Librabry | Masuk']
        );
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:5|max:255',
        ]);

        if (Auth::attempt($validateData)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withInput()->with('message', 'Email atau password kamu salah!');
    }
}
