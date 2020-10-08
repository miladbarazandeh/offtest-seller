<?php

namespace App\Http\Controllers;

class PublicController extends Controller
{

    public function displayImage($path)
    {
        $file = \Storage::get($path);
        $response = response()->make($file, 200);
        $response->header("Content-Type", 'image');
        return $response;
    }
}
