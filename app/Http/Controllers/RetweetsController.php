<?php

namespace App\Http\Controllers;

use App\Models\Retweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetweetsController extends Controller
{
    public function createRetweet(Request $request)
    {
        $this->validate($request, [
            'tweet_id' => 'required|integer'
        ]);

        return Retweet::create([
            'tweet_id' => $request->tweet_id,
            'user_id' => Auth::user()->id,
        ]);
    }
}
