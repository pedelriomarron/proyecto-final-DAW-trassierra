<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Car;
use App\Models\Favorite;
use App\Models\Brand;
use App\Models\ImageGallery;
use App\Models\Drive;
use App\Models\Bodystyle;
use App\Models\Concessionaire;
use App\Models\Segment;
use App\Models\Expert;

class FavoriteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $brands = Brand::select('id', 'name')->get();
        $bodystyles = Bodystyle::select('id', 'name')->get();
        $segments = Segment::select('id', 'name', 'letter')->get();
        $drives = Drive::select('id', 'name')->get();
        $title = "Mis Favoritos";

        $favs = Favorite::where("user_id", "=", Auth::user()->id)->get();
        $favNum = [];
        foreach ($favs as $key => $value) {

            array_push($favNum, $value->car_id);
        }
        $cars = Car::whereIn('id', $favNum)->get();

        return view('cars.index', ["title" => $title, 'cars' => $cars, 'brands' => $brands, 'bodystyles' => $bodystyles, "segments" => $segments, "drives" => $drives]);
    }



    public function save($id)
    {
        $userId = Auth::id();

        $fav = Favorite::findOrCreate($id, $userId);

        if (!$fav) {
            Favorite::create([
                'car_id' => $id,
                'user_id' => $userId,
            ]);
        } else {
            $fav->delete();
        }

        return redirect()->back()->with('success', "");
    }
}
