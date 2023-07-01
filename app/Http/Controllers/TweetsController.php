<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'tweet' => 'min:3|max:140'
        ]);

        $tweet = Tweet::create([
            'text' => $request->tweet,
            'user_id' => Auth::user()->id,
        ]);

        return $tweet->load('user');
    }
    public function getByUser(Request $request)
    {
        return Tweet::where('user_id', $request->user_id)->orderBy('created_at')->paginate(10);
    }
    public function getAll(Request $request)
    {
        return Tweet::orderBy('created_at')->paginate(10);
    }
}
