<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrCollection;
use App\Models\PrCvet;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $prCollection = PrCollection::find($id);
        $prCvets = PrCvet::where('pr_collection_id', $id)->get();
        return view('pr_collection.show', compact('prCollection', 'prCvets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $prCollection = PrCollection::find($id);
        return view('pr_collection.edit', compact('prCollection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $prCollection = PrCollection::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        $name = $request->name;
        $nickname = $request->nickname;
        $description = $request->description;
        $default_price = $request->default_price;
        $category_id = $request->category_id;

        $prCollection->fill(compact(
            'name',
            'nickname',
            'description',
            'default_price',
            'category_id',
        ));

        $prCollection->save();

        if($nickname) {
            $prCvets = PrCvet::where('pr_collection_id', $id)->get();
            $prCvets->each(function($prCvet) use ($prCollection, $nickname) {
                $collectionName = $nickname;
                $nameInCollection = $prCvet->name_in_folder;
                $title = "$collectionName $nameInCollection";
                $prCvet->title = $title;
                $prCvet->save();
            });
        }

        return redirect()->route('pr_collections.index');
    }
}
