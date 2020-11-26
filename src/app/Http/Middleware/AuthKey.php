<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Api;


class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //$token = $request->bearerToken();
        $token = $request->header('key');
        $user = $request->header('user');

        $api = Api::where('user_id', '=', $user)->where('key', '=', $token)->get();


        if (count($api) > 0) {
            return $next($request);
        }


        return response()->json(['msg' => 'API NO Permitida con estos parámetros: ' . $user . " y " . $token], 401);
    }
}
