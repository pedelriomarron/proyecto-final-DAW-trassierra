<?php

use App\User;

function getUsername($userId)
{
    return \DB::table('users')->where('id', $userId)->first()->name;
}

function getUserById($userId)
{
    //return \DB::table('users')->where('id', $userId)->first();
    return User::findOrFail($userId);
}



function set_active($path, $active = 'active')
{
    $current = \Route::currentRouteName();

    foreach ($path as $p) {
        if ($p == $current) return $active;

        $math = substr($p, -1) == "*" ? true : false;
        $length = strlen($p);
        $newStr = substr($current, 0, $length - 1);
        if ($math == true && $newStr == substr($p, 0, -1)) return $active;
    }

    return '';
}



function getExtension($mime_type)
{

    $extensions = array(
        'image/jpeg' => 'jpeg',
        'text/xml' => 'xml',
        'image/png' => 'png'
    );

    // Add as many other Mime Types / File Extensions as you like

    return $extensions[$mime_type];
}
