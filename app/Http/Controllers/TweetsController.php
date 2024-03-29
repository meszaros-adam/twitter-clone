<?php

namespace App\Http\Controllers;

use App\Models\Retweet;
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
        $retweet = Retweet::where('retweets.user_id', $request->user_id)
            ->join('tweets', 'tweets.id', '=', 'retweets.tweet_id')
            ->join('users', 'retweets.user_id', '=', 'users.id')
            ->selectRaw('tweets.*, retweets.id AS retweet_id, DATE_FORMAT(retweets.created_at, "%Y/%m/%d %H:%i")  AS retweet_created_at, retweets.user_id AS retweet_user_id, users.nickname AS retweet_user_nickname, retweets.created_at  AS most_recent_date');

        $tweets = Tweet::where('tweets.user_id', $request->user_id)->selectRaw('tweets.*, null AS retweet_id, null AS retweet_created_at, null AS retweet_user_id, null AS retweet_user_nickname, tweets.created_at AS most_recent_date');

        return $tweets->union($retweet)->orderBy('most_recent_date', 'desc')->paginate(10);
    }
    public function getFolloweds()
    {

        $followeds = array_column(Auth::user()->followeds->toArray(), 'followed_id');

        //get only the tetweeted tweets
        $retweets = Retweet::whereIn('retweets.user_id', $followeds)
            ->join('tweets', 'tweets.id', '=', 'retweets.tweet_id')
            ->join('users', 'retweets.user_id', '=', 'users.id')
            ->selectRaw('tweets.*, retweets.id AS retweet_id, DATE_FORMAT(retweets.created_at, "%Y/%m/%d %H:%i") AS retweet_created_at, retweets.user_id AS retweet_user_id, users.nickname AS retweet_user_nickname, retweets.created_at  AS most_recent_date');

        //get union of all tweets and retweeted tweets

        $tweets =  Tweet::whereIn('user_id', $followeds)->selectRaw('tweets.*, null AS retweet_id, null AS retweet_created_at, null AS retweet_user_id, null AS retweet_user_nickname, tweets.created_at AS most_recent_date');

        return $tweets->union($retweets)->orderBy('most_recent_date', 'desc')->paginate(10);
    }

    public function getAll()
    {
        //get only the retweeted tweets
        $retweets = Retweet::join('tweets', 'tweets.id', '=', 'retweets.tweet_id')
            ->join('users', 'retweets.user_id', '=', 'users.id')
            ->selectRaw('tweets.*, retweets.id AS retweet_id, DATE_FORMAT(retweets.created_at, "%Y/%m/%d %H:%i")  AS retweet_created_at, retweets.user_id AS retweet_user_id, users.nickname AS retweet_user_nickname, retweets.created_at  AS most_recent_date');

        //get union of all tweets and retweeted tweets
        $tweets = Tweet::selectRaw('tweets.*, null AS retweet_id, null AS retweet_created_at , null AS retweet_user_id, null AS retweet_user_nickname,tweets.created_at AS most_recent_date');

        return $tweets->union($retweets)->orderBy('most_recent_date', 'desc')->paginate(10);
    }
}
