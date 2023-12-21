<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait Util
{
    public function uploadAvatar(Request $request): string
    {
        $nameImage = Str::random(10);
        $fileName = "${ $nameImage }.jpg";
        $request->file('avatar')->storeAs('avatar', $fileName, 'public');
        return $fileName;
    }

    public function uploadImage(Request $request)
    {

    }
}