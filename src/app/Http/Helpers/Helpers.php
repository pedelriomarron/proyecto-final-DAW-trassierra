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
