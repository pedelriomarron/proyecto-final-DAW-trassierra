<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodystyle;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Lang;


class BodystyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bodystyle::latest()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '';
                    if (\Auth::user()->can('bodystyle-edit')) {
                        $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">' . Lang::get('edit') . '</button>';
                    }
                    if (\Auth::user()->can('bodystyle-delete')) {
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm">' . Lang::get('delete') . '</button>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.bodystyles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bodystyles.create');
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
            $image->move(public_path('uploads/bodystyles'), $new_name);
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



        Bodystyle::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bodystyle  $bodystyle
     * @return \Illuminate\Http\Response
     */
    public function show(Bodystyle $bodystyle)
    {
        return view('bodystyles.show', compact('bodystyle'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bodystyle  $bodystyle
     * @return \Illuminate\Http\Response
     */
    public function edit(Bodystyle $bodystyle)
    {

        if (request()->ajax()) {
            //$data = Bodystyle::findOrFail($id);
            return response()->json(['result' => $bodystyle]);
        }

        return view('bodystyles.edit', compact('bodystyle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bodystyle  $bodystyle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bodystyle $bodystyle)
    {


        $validation = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $new_name = false;
        if ($validation->passes()) {
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bodystyles'), $new_name);
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

        Bodystyle::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bodystyle  $bodystyle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Bodystyle::findOrFail($id);
        $data->delete();
    }
}
