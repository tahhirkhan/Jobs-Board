<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    // public function store() {
    //     // validate:
    //     $validatedAttributes = request()->validate([
    //         'first_name' => ['required'],
    //         'last_name' => ['required'],
    //         'email' => ['required', 'email'],
    //         'password' => ['required', Password::min(6), 'confirmed'],
    //     ]);

    //     // create the user:
    //     $user = User::create($validatedAttributes);

    //     // log in:
    //     Auth::login($user);

    //     // redirect:
    //     return redirect('/jobs');
    // }

    public function store()
    {
        // validate:
        $validatedAttributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);

        // hash the password: (for older versions of laravel, otherwise it is automatically defined in the User model)
        $validatedAttributes['password'] = bcrypt($validatedAttributes['password']);

        // create the user:
        $user = User::create($validatedAttributes);

        // log in:
        Auth::login($user);

        // redirect:
        return redirect('/jobs');
    }
}
