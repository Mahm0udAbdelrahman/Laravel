<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();
        return view("albums.index" , compact("albums"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("albums.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        "title"=> "required|string",
       ]);
       Album::create([
        "title"=> $request->title,
       ]);
       return redirect()->route("album.index")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album , string $id)
    {

        $album = Album::find($id);
        $photos = $album->getMedia('album');
        return view("albums.show" , compact('album','photos'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album ,$id)
    {

        $album = Album::find($id);
        return view("albums.edit" , compact("album"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request ,$id)
    {
          $request->validate([
            "title"=> "required|string",
           ]);

            $album = Album::find($id);



           $album->update([
            "title"=> $request->title,
           ]);
           return redirect()->route("album.index")->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        $album->delete();
        return redirect()->route("album.index");

    }


    public function upload(Request $request , Album $album)
    {
        // dd($request  , $album);

        if ($request->has('image')) {
            $uploadImage = $album->addMultipleMediaFromRequest(['image'])->each(function ($uploadImage) {
                            $uploadImage->toMediaCollection('album');
                        });
        }


        // if ($request->hasFile('photo')) {
        //     $fileAdders = $listing->addMultipleMediaFromRequest(['photo'])
        //         ->each(function ($fileAdder) {
        //             $fileAdder->toMediaCollection('photos');
        //         });
        // }




        return redirect()->route('album.show', $album->id);

    }
    public function showImage(Album $album , $id)
    {
        $media = $album->getMedia('album');
        $image = $media->where('id', $id)->first();
        return view('albums.image-show', compact('album', 'image'));


    }

    public function destroyImage(Album $album , $id)
    {
        $media = $album->getMedia('album');
        $image = $media->where('id', $id)->first();
        $image->delete();

        return redirect()->route('album.show');


    }

}
