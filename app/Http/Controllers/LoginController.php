<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {

        return view('login');
    }

    public function authenticate()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:255', 'min:7'],
        ]);

        if (auth()->attempt($attributes)) {
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Your provided credentials could not be verified.']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
