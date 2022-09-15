<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrCollection;
use App\Models\PrImage;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PrCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $collections = PrCollection::all();
        return view('pr_collection.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pr_collection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string']
        ]);


        $pr_collection = \App\Models\PrCollection::create ([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $path = $request->file('image')->store('pr_collection_images');
        // доступ по asset('storage/' . $path)
        

        $pr_image = \App\Models\PrImage::create ([
            'orig_img' => $path,
            'imageable_id' => $pr_collection->id,
            'imageable_type' => \App\Models\PrCollection::class,
        ]);

        $pr_image->make_resizes([
            [300, 300],
            [500, 600]
        ]);

        $asset = asset('storage/' . $pr_image->original);
        return '<img src="' . $asset . '" />';

        return redirect()->route('pr_collection.index');

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
