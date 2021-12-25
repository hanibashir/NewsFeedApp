<?php

namespace App\Http\Controllers;


use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    public function create()
    {
        return view('user.session.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your credentials could not be verified!'
            ]);

        }

        session()->regenerate();
        return redirect('/')->with('success', 'Welcome back!');



        //return back()->withInput()->withErrors(['email' => 'Your credentials could not be verified!']);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye');
    }
}
