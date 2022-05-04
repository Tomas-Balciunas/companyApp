<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'password' => 'required'
        ]);

        $cred = $request->only('user_email', 'password');

        if (Auth::attempt($cred)) {
            return redirect()->intended('/')->with('message', 'You have successfully logged in!');
        }

        return back()->with('warning', 'Incorrect email and/or password!');


        // $user = User::where(['user_email' => $request->logemail])->first();

        // if ($user) {
        //     if (Hash::check($request->logpassword, $user->password)) {
        //         $request->session()->put('user_id', $user->id);
        //     } else {
        //         return back()->with('warning', 'Incorrect password!');
        //     }
        // } else {
        //     return back()->with('warning', 'User with this email does not exist!');
        // }
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'user_email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:16'
        ]);

        User::create([
            'username' => $request->username,
            'user_email' => $request->user_email,
            'password' => Hash::make($request->password)
        ]);

        return back()->with('message', 'Registration successful! You may now log in.');
    }

    public function logout (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/auth')->with('message', 'You have successfully logged out');
    }
}
