<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\helper\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Contracts\Session\Session;

class AuthController extends Controller
{

    use Authenticatable;


    public function show_register(){

        return view('auth.register');

    }


    public function register(RegisterRequest $request ){

        $validated = $request->validated();


            if($request->hasFile('image')){


            $validated['image']=UploadHelper::SingleUpload($request->image,'profile');;
            }


            User::create($validated);

        return redirect('/login')->with('success','User created successfully');

    }

  public function logout(Request $request){

    Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');

  }
 }
