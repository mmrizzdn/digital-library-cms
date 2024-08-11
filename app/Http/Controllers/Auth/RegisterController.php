<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view(
            'auth.register',
            ['title' => 'Ammar DIgital Library | Daftar']
        );
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'confirmPassword' => 'required|min:5|max:255',

        ]);

        $exists = User::where('email', '=', $validateData['email'])->first();

        if ($exists) {
            return back()->withInput()->with('message', 'Email yang kamu masukkan tidak valid!');
        }

        if ($validateData['password'] != $validateData['confirmPassword']) {
            return back()->withInput()->with('message', 'Password yang kamu masukkan tidak sama!');
        }

        $user = new User();
        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        $user->password = Hash::make($validateData['password'], ['rounds' => 12]);
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('dashboard');
    }
}
