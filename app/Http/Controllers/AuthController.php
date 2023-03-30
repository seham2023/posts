<?php

namespace App\Http\Controllers;

use App\helper\UploadHelper;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;


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


 }
