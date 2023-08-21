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

        $retweet =  Retweet::create([
            'tweet_id' => $request->tweet_id,
            'user_id' => Auth::user()->id,
        ]);


        return Retweet::where('retweets.id', $retweet->id)
            ->join('tweets', 'tweets.id', '=', 'retweets.tweet_id')
            ->join('users', 'retweets.user_id', '=', 'users.id')
            ->selectRaw('tweets.*, retweets.id AS retweet_id, DATE_FORMAT(retweets.created_at, "%Y/%m/%d %H:%i")  AS retweet_created_at, retweets.user_id AS retweet_user_id, users.nickname AS retweet_user_nickname, retweets.created_at  AS most_recent_date')->first();
    }

    public function deleteRetweet(Request $request)
    {
        $this->validate($request, [
            'tweet_id' => 'required|integer'
        ]);

        return Retweet::where([
            ['user_id', Auth::user()->id],
            ['tweet_id', $request->tweet_id],
        ])->delete();
    }
}
