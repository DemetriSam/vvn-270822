<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PrCollection;
use App\Models\PrCvet;
use App\Models\PrImage;
use App\Models\PropertyValue;
use App\Models\Rate;
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
        $rate = Rate::firstWhere('currency', 'eur');
        return view('pr_collection.index', compact('collections', 'rate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('pr_collection.create', ['categories' => $categories]);
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
            'nickname' => $request->nickname,
            'description' => $request->description,
            'default_price' => $request->default_price,
            'category_id' => $request->category_id,
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

        return redirect()->route('pr_collections.edit', ['pr_collection' => $pr_collection]);
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
        $categories = Category::all();
        $prCollection = PrCollection::find($id);
        return view('pr_collection.edit', compact('prCollection', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PrCollection $prCollection)
    {
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

        if (isset($request->properties)) {
            foreach ($request->properties as $property_id => $value) {
                $oldValue = PropertyValue::firstWhere('property_id', $property_id);
                if ($oldValue) {
                    $prCollection->properties()->detach($oldValue->id);
                }
                $prCollection->properties()->attach($value);
            }
        }


        $prCollection->save();

        if ($nickname) {
            $prCvets = PrCvet::where('pr_collection_id', $prCollection->id)->get();
            $prCvets->each(function ($prCvet) use ($nickname) {
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
