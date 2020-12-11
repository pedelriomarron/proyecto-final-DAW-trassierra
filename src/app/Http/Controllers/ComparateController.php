<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App;

class ComparateController extends Controller
{
    //
    public function index()
    {

        $cars = Car::all();


        return view('comparate.index', compact('cars'));
    }
}
