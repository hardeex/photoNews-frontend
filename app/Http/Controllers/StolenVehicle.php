<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StolenVehicle extends Controller
{
    public function create()
    {
        return view("vehicle.create");
    }
}
