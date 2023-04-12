<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApiAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['login']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'As credenciais fornecidas estão incorretas.'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('access_token');

        return Redirect::route('home');
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return Redirect::route('login');
    }
}
