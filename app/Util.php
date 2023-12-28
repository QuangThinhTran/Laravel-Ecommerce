<?php

namespace App;

use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait Util
{
    public function uploadAvatar(Request $request): string
    {
        if (!$request->file()) {
            return false;
        }

        $nameImage = Str::random(10);
        $fileName = "{ $nameImage }.jpg";
        $request->file('avatar')->storeAs('avatar', $fileName, 'public');
        return $fileName;
    }

    public function uploadImages(Request $request, $product_id)
    {
        if (!$request->file()) {
            return false;
        }
        $images = $request->file('path');
        foreach ($images as $img) {
            $nameImage = Str::random(10);
            $fileName = "{$nameImage }.jpg";
            $img->storeAs('images', $fileName, 'public');
            Images::insert([
                'path' => $fileName,
                'product_id' => $product_id
            ]);
        }
    }
}