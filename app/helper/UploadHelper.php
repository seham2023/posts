<?php

namespace App\helper;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

final class UploadHelper
{
    /**
     * Upload and loop in main function || upload single image
     *
     * @param Request $request
     * @param string $direction
     * @return void
     */
    public static function Up($images, $direction = 'images'): array
    {
        $upImages = [];
        foreach ($images as $key => $img) {
            // //dd($key,$img);
            # code...
            $prepare = Image::make($img);
            // calculate md5 hash of encoded image
            $hash = md5($prepare->__toString());
            // Get Ext
            $ext = 'png';
            // Get User
            $user = auth()->user();
            //  Get Path

////////////////////////////////
$id = $user->id ?? 1;
$path = "public/{$direction}/{$id}/{$key}/{$hash}" . Carbon::now()->timestamp . ".{$ext}";
            /////////////////////////////////////
            // $path = "public/{$direction}/{$user->id}/{$key}/{$hash}" . Carbon::now()->timestamp . ".{$ext}";
            // Stream Image
            // $prepare->encode();
            $prepare = $prepare->stream();
            $storage = Storage::disk('local')->put($path, $prepare);
            $upImages[$key] = Storage::url($path);
        }
        return $upImages;
    }
    public static function SingleUpload($img, $direction = 'images', $name = 'images')
    {


        // //dd($key,$img);
        # code...
        $prepare = Image::make($img);
        // calculate md5 hash of encoded image
        $hash = md5($prepare->__toString());
        // Get Ext
        $ext = 'png';
        // Get User
        $user = auth()->user();
        //  Get Path

        ///////////////
        $id = $user->id ?? 1;
        $path = "public/{$direction}/{$id}/{$name}/{$hash}" . Carbon::now()->timestamp . ".{$ext}";
        // $path = "public/{$direction}/{$user->id}/{$name}/{$hash}" . Carbon::now()->timestamp . ".{$ext}";
        // Stream Image
        // $prepare->encode();
        $prepare = $prepare->stream();
        $storage = Storage::disk('local')->put($path, $prepare);
        return Storage::url($path);
    }
}

