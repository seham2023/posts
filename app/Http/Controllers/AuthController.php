<?php

namespace App\Http\Controllers;

use App\helper\UploadHelper;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use Authenticatable;


    public function show_register(){

        return view('auth.register');

    }


    public function register(Request $request ){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
            $newuser=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'password'=>Hash::make($request->password)
            ]);

            if($request->hasFile('image')){
            $img=UploadHelper::SingleUpload($request->image,'profile');
            $newuser->update(['image'=>$img]);
            }

        return redirect('/login')->with('success','User created successfully');

    }


    public function show_login(){

        return view('auth.login');

    }






 }
