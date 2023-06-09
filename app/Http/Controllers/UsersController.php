<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //auth
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
            'password' => Hash::make($request->password),
        ]);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->stayLoggedIn;

        if (Auth::attempt($credentials, $remember)) {
            return response('Succesfull login!', 200);
        } else {
            return response('Login failed!', 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function getUser(Request $request)
    {
        return User::find($request->id);
    }
}
