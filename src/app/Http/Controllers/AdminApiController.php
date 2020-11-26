<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;

class AdminApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('role:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $apis = Api::where('user_id', '=', auth()->user()->id)->get();



        return view('admin.api', ['apis' => $apis]);
    }


    public function generate()
    {
        $apis = Api::where('user_id', '=', auth()->user()->id)->get();

        if (count($apis) == 0) {

            $api = new Api;

            $api->key = generateToken();
            $api->user_id = auth()->user()->id;

            $api->save();
        }




        return back()->withInput();
    }
}
