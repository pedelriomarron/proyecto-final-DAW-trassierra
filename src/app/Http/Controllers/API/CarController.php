<?php

namespace App\Http\Controllers\API;

use App\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function getAllCars()
    {
        $Cars = Car::get()->toJson(JSON_PRETTY_PRINT);
        return response($Cars, 200);
    }

    public function getCar($id)
    {
        if (Car::where('id', $id)->exists()) {
            $Car = Car::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($Car, 200);
        } else {
            return response()->json([
                "message" => "Car not found"
            ], 404);
        }
    }
}
