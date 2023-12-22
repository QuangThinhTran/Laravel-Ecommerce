<?php

namespace App;

use App\Models\Images;
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
        if ($request->file()) {
            return false;
        }
        $images = $request->file();
        foreach ($images as $img) {
            Images::insert([
                'path' => $img,
                'post_id' => $request->post_id
            ]);
        }
    }
}