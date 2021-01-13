<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\ImageGallery;
use App\Models\Drive;
use App\Models\Bodystyle;
use App\Models\Concessionaire;
use App\Models\Segment;
use App\Models\Expert;
use Illuminate\Http\Request;
use DataTables;
use URL;
use Auth;
use Illuminate\Support\Facades\Lang;
use Route;
use Merujan99\LaravelVideoEmbed\Facades\LaravelVideoEmbed;


class CarController extends Controller
{

    public function show_car($id)
    {


        $car = Car::findOrFail($id);
        $params = [
            "allow" => "autoplay; encrypted-media",
            "frameborder" => '0',
            "width" => "560",
            "height" => "315",
        ];

        $experts = Expert::where("brand_id", "=", $car->brand_id)->get();
        $expertsNum = [];
        foreach ($experts as $key => $value) {

            array_push($expertsNum, $value->user_id);
        }
        $conses = Concessionaire::whereIn('user_id', $expertsNum)->get();


        //Optional attributes for embed container
        $attributes = [
            'type' => null,
            'class' => 'iframe-class',
            'data-html5-parameter' => true
        ];

        $car->yt_iframe = LaravelVideoEmbed::parse($car->youtube, ['YouTube'], $params, $attributes);
        $images = ImageGallery::where('car_id', '=', $car->id)->orderBy('order')->get();



        $similars = Car::inRandomOrder()->where('id', '!=', $car->id)->limit(3)->get();


        return view('cars.show', ['car' => $car, "images" => $images, "similars" => $similars, "conses" => $conses]);
    }




    public function public_index()
    {
        $brands = Brand::select('id', 'name')->get();
        $bodystyles = Bodystyle::select('id', 'name')->get();
        $segments = Segment::select('id', 'name', 'letter')->get();
        $drives = Drive::select('id', 'name')->get();
        $title = "All electric vehicles";




        $cars = Car::all();
        return view('cars.index', ["title" => $title, 'cars' => $cars, 'brands' => $brands, 'bodystyles' => $bodystyles, "segments" => $segments, "drives" => $drives]);
    }


    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            if (Auth::user()->hasRole('Admin|Editor')) {
                $data = Car::latest()->get();
            } elseif (Auth::user()->hasRole('Expert')) {
                $data3 = Car::latest()->get();
                $data = [];
                $brands = Expert::where('user_id', '=', Auth::user()->id)->get();
                $data = researchExpert($data3, $brands);
            }



            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '';
                    if (\Auth::user()->can('car-edit')) {
                        $button .= '<a href="' . route('cars.edit', ['car' => $data->id]) . '" type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">' . Lang::get('edit') . '</a>';
                    }
                    if (\Auth::user()->can('car-delete')) {
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm">' . Lang::get('delete') . '</button>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.cars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$brands = Brand::pluck('name', 'id', 'logo')->toArray();;
        //$brands = Brand::selectRaw("CONCAT ('name', 'logo') as columns, id")->pluck('columns', 'id');
        $brands = Brand::select('id', 'name', 'logo')->get();
        $images = ImageGallery::orderBy('order')->get();
        $bodystyles = Bodystyle::select('id', 'name', 'logo')->get();
        $segments = Segment::select('id', 'name', 'logo')->get();
        $drives = Drive::select('id', 'name', 'logo')->get();
        $car = new Car;
        $action = URL::route('cars.store');



        return view('admin.cars.create', ['brands' => $brands, 'images' => $images, 'drives' => $drives, 'segments' => $segments, 'bodystyles' => $bodystyles, "car" => $car, "action" => $action]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'segment_id' => 'required',
            'drive_id' => 'required',
            'bodystyle_id' => 'required'
        ]);


        /*

   Car::create([
            'title' => $request->name,
            'brand_id' => 2,
        ]);

        */
        Car::create($request->all());





        return redirect()->route('cars.index')
            ->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {


        if (Auth::user()->hasRole('Expert')) {
            try {
                $brands = Expert::where('user_id', '=', Auth::user()->id)->get();
                $data = researchExpert([$car], $brands);
                $car = $data[0];
            } catch (\Throwable $th) {
                abort(401);
            }
        }


        $brands = Brand::select('id', 'name', 'logo')->get();
        $images = ImageGallery::where('car_id', '=', $car->id)->orderBy('order')->get();
        $bodystyles = Bodystyle::select('id', 'name', 'logo')->get();
        $segments = Segment::select('id', 'name', 'logo')->get();
        $drives = Drive::select('id', 'name', 'logo')->get();
        $action = URL::route('cars.store');


        return view('admin.cars.create', ['car' => $car, 'brands' => $brands, 'images' => $images, 'drives' => $drives, 'segments' => $segments, 'bodystyles' => $bodystyles, "car" => $car, "action" => $action]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {

        if (Auth::user()->hasRole('Expert')) {
            try {
                $brands = Expert::where('user_id', '=', Auth::user()->id)->get();
                $data = researchExpert([$car], $brands);
                $car = $data[0];
            } catch (\Throwable $th) {
                abort(401);
            }
        }


        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'segment_id' => 'required',
            'drive_id' => 'required',
            'bodystyle_id' => 'required'
        ]);



        $car->update($request->all());


        return redirect()->back()->with('success', 'Car updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */

    /*
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully');
    }
*/
    public function destroy($id)
    {
        $data = Car::findOrFail($id);
        $data->delete();
    }
}
