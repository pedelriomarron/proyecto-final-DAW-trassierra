<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Expert;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Auth;
use Image;
use DataTables;
use Illuminate\Support\Facades\Lang;
use App\Models\Brand;



class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->where('id', "!=", 1)->whereHas(
                'roles',
                function ($q) {
                    $q->where('name', 'Expert');
                }
            )->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '';



                    if (\Auth::user()->can('user-edit')) {
                        $button .= '<a class="btn btn-primary btn-sm" href="' . route('experts.edit', $data->id) . '">' . Lang::get('edit') . '</a>';
                    }


                    if (\Auth::user()->can('user-delete')) {
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button"  id="' . $data->id . '"  class="delete btn btn-danger btn-sm" >' . Lang::get('delete') . '</button>';
                    }

                    return $button;
                })
                ->addColumn('roles', function ($data) {
                    $button = "";
                    $user = getUserById($data->id);
                    if (!empty($user->getBrandNames())) {
                        foreach (getUserById($data->id)->getBrandNames() as $v) {
                            $button .=   "<label class='badge badge-success'>" . $v . "</label>";
                        }
                    }

                    return $button;
                })
                ->rawColumns(['action', 'roles'])
                ->make(true);
        }
        return view('admin.experts.index');
    }




    public function edit($id)
    {
        try {
            if ($id == 1)   return redirect()->route('admin');
            $user = User::find($id);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->all();
            $brands = Brand::select('id', 'name', 'logo')->get();
            $old_records = Expert::where('user_id', '=', $id)->get();

            return view('admin.experts.edit', compact('user', 'brands', 'old_records'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin');
        }
    }



    public function update(Request $request, $id)
    {
        $user = User::find($id);


        $this->validate($request, [
            'name' => 'required',
            'brands' => 'required',
        ]);

        $old_records = Expert::where('user_id', '=', $id)->delete();
        foreach ($request->brands as $key => $value) {
            Expert::create([
                'brand_id' => $value,
                'user_id' => $id
            ]);
        }


        $input = $request->all();
        $user->update($input);

        return redirect()->route('experts.index')
            ->with('success', 'Experts editado successfully');
    }
}
