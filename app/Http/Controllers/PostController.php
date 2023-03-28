<?php

namespace App\Http\Controllers;

use App\helper\UploadHelper;
use App\Models\Comment;
use App\Models\image;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with('comments')->get();
        $comments=Comment::with('replies')->get();

        return view('front.comments',compact('posts','comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $newpost=  Post::create($request->except('image'));
        if($request->has('images')){
            if(count($request->images)>0){
                $images=UploadHelper::Up($request->images,'posts');
                $newpost->update(['image'=>$images[0]]);


                if (count($images) > 1) {
                    foreach ($images as $key => $img) {
                        image::create([
                            'filename' => $img,
                            'imageable_id' => $newpost->id,
                            'imageable_type' => Post::class
                        ]);
                    }
                }
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
