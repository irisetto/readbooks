<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyBooksController extends Controller
{
    public function index()
    {
        return view('my_books');
    }
}
