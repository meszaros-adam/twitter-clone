<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function createComment(Request $request)
    {

        $this->validate($request, [
            'text' => 'required|min:3',
            'tweet_id' =>'required|int'
        ]);

        return Comment::create([
            'text' => $request->text,
            'tweet_id' => $request->tweet_id,
            'user_id' => Auth::user()->id,
        ]);
    }
}
