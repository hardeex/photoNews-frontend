<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CelebrationController extends Controller
{
    public function createBirthday()
    {
        return view("birthday.create");
    }


    public function createWedding()
    {
        return view("wedding.create");
    }

    public function createDedication()
    {
        return view("dedication.create");
    }
}
