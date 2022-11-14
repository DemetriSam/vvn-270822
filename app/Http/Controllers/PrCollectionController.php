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
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $collections = PrCollection::all();
        return view('pr_collection.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pr_collection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {



        $request->validate([
            'name' => ['required', 'string'],
        ]);


        $pr_collection = \App\Models\PrCollection::create([
            'name' => $request->name,
            'description' => $request->description,
            'default_price' => $request->price,
            'category_id' => $request->category,
        ]);
        if ($request->file('image')) {
            $path = $request->file('image')->store('pr_collection_images');
            $pr_image = \App\Models\PrImage::create([
                'orig_img' => $path,
                'imageable_id' => $pr_collection->id,
                'imageable_type' => \App\Models\PrCollection::class,
            ]);

            $asset = asset('storage/' . $pr_image->orig_img);
            return '<img src="' . $asset . '" />';
        }

        return redirect()->route('pr_collections.index');
    }
}
