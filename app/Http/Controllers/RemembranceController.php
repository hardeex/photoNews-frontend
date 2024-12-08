<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemembranceController extends Controller
{
    public function createPost()
    {
        return view('remembrance.create');
    }
}
