<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use DataTables;
use Validator;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::latest()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '';
                    if (\Auth::user()->can('brand-edit')) {
                        $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    }
                    if (\Auth::user()->can('brand-delete')) {
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validation = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $new_name = "";
        if ($validation->passes()) {
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands'), $new_name);
        } else {
            $new_name = "default.png";
        }



        $rules = array(
            'name'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'    =>  $request->name,
            'logo' =>  $new_name,
        );



        Brand::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {

        if (request()->ajax()) {
            //$data = Brand::findOrFail($id);
            return response()->json(['result' => $brand]);
        }

        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {


        $validation = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $new_name = false;
        if ($validation->passes()) {
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands'), $new_name);
        }


        $rules = array(
            'name'        =>  'required',
        );

        $error = Validator::make($request->all(), $rules);


        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'    =>  $request->name,
            'logo' =>  $new_name,
        );
        if (!$new_name) {
            unset($form_data['logo']);
        }

        Brand::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Brand::findOrFail($id);
        $data->delete();
    }
}
