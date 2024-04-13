<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Login Success');;

        }
        return back()->withErrors([
            'email_login' => 'The provided credentials do not match our records.',
            'password_login' => 'The password is not correct..',
        ]);
    }
    public function logout()
    {
        Auth::logout();
  
        return redirect('/');
    }
}
