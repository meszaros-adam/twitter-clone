<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'picture' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $filename = time() . '.' . request()->picture->getClientOriginalExtension();
        request()->picture->move(public_path('images'), $filename);
    }
}
