<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        return User::create([
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }
}
