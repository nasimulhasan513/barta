<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store()
    {
        // Validate the user
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'min:3', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'max:255', 'min:7'],
        ]);

        DB::table('users')->insert([
            'name' => $attributes['name'],
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password']),
        ]);

        return redirect('/login');
    }
}
