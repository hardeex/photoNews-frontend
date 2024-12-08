<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class changeOfNameController extends Controller
{
    public function createPost()
    {
        return view('change-of-name.create');
    }
}
