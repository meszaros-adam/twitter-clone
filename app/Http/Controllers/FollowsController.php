<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    public function createFollow(Request $request)
    {
        $this->validate($request, [
            'followed_id' => 'required|integer'
        ]);

        return Follow::create([
            'follower_id' => Auth::user()->id,
            'followed_id' => $request->followed_id,
        ]);
    }

    public function deleteFollow(Request $request)
    {
        $this->validate($request, [
            'followed_id' => 'required|integer'
        ]);

        return Follow::where(
            [
                ['follower_id', Auth::user()->id],
                ['followed_id', $request->followed_id]
            ]
        )->delete();
    }

    public function getFollowedList(){
        $follows = Follow::where('follower_id', Auth::user()->id)->get();

        return $follows;
    }
}
