<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Auth;
use Image;
use DataTables;
use Illuminate\Support\Facades\Lang;


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
            $data = User::latest()->where('id',"!=" ,1)->whereHas(
            'roles', function($q){
            $q->where('name', 'Expert');
            }
            )->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '';



                    if (\Auth::user()->can('user-edit')) {
                        $button .= '<a class="btn btn-primary btn-sm" href="' . route('users.edit', array('user' => $data->id)) . '">'.Lang::get('edit').'</a>';
                    }

              
                    if (\Auth::user()->can('user-delete')) {
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button"  id="' . $data->id . '"  class="delete btn btn-danger btn-sm" href="' . route('users.edit', array('user' => $data->id)) . '">'.Lang::get('delete').'</button>';
                    }

                    return $button;
                })
                ->addColumn('roles', function ($data) {
                    $button = "";
                    $user = getUserById($data->id);
                    if (!empty($user->getRoleNames())) {
                        foreach (getUserById($data->id)->getRoleNames() as $v) {
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

}