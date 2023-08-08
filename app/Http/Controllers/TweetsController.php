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
        return Tweet::where('user_id', $request->user_id)->orderBy('created_at', 'desc')->paginate(10);
    }
    public function getAll(Request $request)
    {
        //get only the tetweeted tweets
        $retweets = Tweet::orderBy('retweets.created_at', 'desc')
            ->join('retweets', 'tweets.id', '=', 'retweets.tweet_id')
            ->selectRaw('tweets.*, retweets.created_at AS retweet_created_at, retweets.user_id AS retweet_user_id');

        //get union of all tweets and retweeted tweets
        return Tweet::selectRaw('tweets.*, null AS retweet_created_at, null AS retweet_user_id')
            ->union($retweets)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
