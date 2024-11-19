<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }


    public function index()
    {
        return view('welcome');
    }

    public function newsCategoryList()
    {
        return view('news.show');
    }

    public function newDetails()
    {
        return view('news.details');
    }
}
