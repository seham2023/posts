<?php

namespace App\Http\Controllers;

use App\helper\UploadHelper;
use App\Models\Comment;
use App\Models\image;
use App\Models\Post;
use Exception;
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

        return view('front.allPosts',compact('posts','comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{

            $newpost=  Post::create($request->except('images'));
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

            return redirect()->back();

        }

        catch(Exception $e){ return redirect()->back()->with('error','an error occured '. $e->getMessage());



        }



    }


    public function update(Request $request, $id)
    {

        $newpost = Post::find($request->id);
        $newpost->update($request->except('images'));

        if ($request->hasFile('images')) {

            $newpost->images()->delete();
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

          return redirect()->back();

        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findorfail($request->id);


        $post->delete();

        return redirect()->back();

    }
}
