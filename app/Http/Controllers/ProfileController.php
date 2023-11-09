<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $name = auth()->user()->name;
        return view('profile', compact('name'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('edit-profile', compact('user'));
    }

    public function update()
    {
        $data = request()->validate([
            'name' => 'required',
            'last-name' => 'required',
            'email' => 'required|email',
        ]);

        if (request('password')) {
            $data['password'] = bcrypt(request('password'));
        }
        if (request('bio')) {
            $data['bio'] = request('bio');
        }

        DB::table('users')
            ->where('id', auth()->user()->id)
            ->update($data);

        return redirect('/profile');
    }
}
