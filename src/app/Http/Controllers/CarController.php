<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\ImageGallery;
use App\Models\Drive;
use App\Models\Bodystyle;
use App\Models\Segment;
use Illuminate\Http\Request;
use DataTables;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Car::latest()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '';
                    if (\Auth::user()->can('car-edit')) {
                        $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">' . Lang::get('edit') . '</button>';
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

        return view('admin.cars.create', ['brands' => $brands, 'images' => $images, 'drives' => $drives, 'segments' => $segments, 'bodystyles' => $bodystyles]);
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
        return view('admin.cars.edit', compact('car'));
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
        $request->validate([
            'name' => 'required',
        ]);
        $car->update($request->all());

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully');
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
