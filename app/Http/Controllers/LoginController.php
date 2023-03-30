<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function show_login(){

        return view('auth.login');
    }

     /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function login(LoginRequest $request)

    {
        if (Auth::attempt([$request->username_type => $request['username'], 'password' => $request['password']], true)) {
            return redirect()->route('home');
        }

        return redirect()->to('login')->withErrors(trans('auth.failed'));
    }

}
