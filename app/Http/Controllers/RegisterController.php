<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserList;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $toReadList = new UserList(['name' => 'To Read', 'user_id' => $user->id]);
        $finishedList = new UserList(['name' => 'Finished', 'user_id' => $user->id]);
    
        $user->user_lists()->saveMany([$toReadList, $finishedList]);
    
        return redirect('/login_register')->with(['alert' =>'Your account has been created! Please log in.']);
    }
}
