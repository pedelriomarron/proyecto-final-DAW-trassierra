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


function getDatatablesURLLang()
{

    $locale = app()->getLocale();

    switch ($locale) {
        case 'en':
            return '//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json';
            break;
        case 'es':
            return '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json';
            break;
        default:
            return '//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json';
    }
}

function generateToken()
{
    return md5(rand(1, 10) . microtime());
}


function researchExpert($data3, $brands)
{
    $data = [];
    foreach ($brands as $key => $brand) {
        foreach ($data3 as $key => $car) {
            if ($brand->brand_id == $car->brand->id) {
                array_push($data, $car);
            }
        }
    }
    return $data;
}
