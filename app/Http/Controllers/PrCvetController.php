<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PrCvet;
use App\Models\PrCollection;
use App\Models\Color;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Services\Pages\FilterLayers;
use App\Services\Tags\ProductSeoTags;
use Illuminate\Routing\Controller;

class PrCvetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(FilterLayers $filters)
    {
        $filter = request('filter');
        $query = PrCvet::orderBy('pr_cvets.id');

        if ($filter) {
            $filters->setFilter($filter);
            $filters->setBase($query);
            $query = $filters->getQuery();
        }

        $prCvets = $query->paginate(20)->withQueryString();
        $prCollections = PrCollection::all();
        $colors = Color::all();

        $properties = Property::all();
        $values = PropertyValue::all();
        $propFilters = $properties->map(function ($property) use ($values) {
            $options = $values->filter(fn ($value) => $value->property_id === $property->id);
            return (object) ['property' => $property, 'options' => $options];
        });

        return view('pr_cvet.index', compact('prCvets', 'prCollections', 'colors', 'propFilters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $prCollections = PrCollection::all();
        $colors = Color::all();
        return view('pr_cvet.create', compact('prCollections', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'name_in_folder' => ['required', 'string', 'unique:pr_cvets'],
            'pr_collection_id' => ['required'],
        ]);
        $prCollection = PrCollection::find($request->pr_collection_id);
        if ($prCollection->name || $prCollection->nickname) {
            $collectionName = $prCollection->nickname ?? $prCollection->name;
        } else {
            $collectionName = 'no collection';
        }
        $nameInCollection = $request->name_in_folder;
        $title = "$nameInCollection $collectionName";

        $currentPrice = $prCollection->default_price;



        $prCvet = \App\Models\PrCvet::create([
            'name_in_folder' => $request->name_in_folder,
            'title' => $title,
            'description' => $request->description,
            'pr_collection_id' => $request->pr_collection_id,
            'current_price' => $currentPrice,
            'color_id' => $request->color_id,
        ]);

        $this->addImages($prCvet, $request);


        return $prCollection ?
            redirect()->route('pr_collections.show', $prCollection) :
            redirect()->route('pr_cvets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(PrCvet $prCvet, ProductSeoTags $seoTags)
    {
        if (!$prCvet->isPublished()) {
            return redirect()->route('catalog', ['category' => $prCvet->category->slug]);
        }

        $seoTags->initLineProvider(['product_id' => $prCvet->id]);
        $title = $seoTags->getTitle();
        $description = $seoTags->getDescription();

        $sameColor = PrCvet::where('color_id', $prCvet->color_id)
            ->whereNot('id', $prCvet->id)
            ->where('pr_cvets.published', 'true')
            ->get()->forPage(1, 12);

        $sameCollection = PrCvet::where('pr_collection_id', $prCvet->pr_collection_id)
            ->whereNot('id', $prCvet->id)
            ->where('pr_cvets.published', 'true')
            ->get()->diff($sameColor)->forPage(1, 12);

        return view('pr_cvet.show', compact('prCvet', 'title', 'description', 'sameColor', 'sameCollection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(PrCvet $prCvet, Request $request)
    {
        $prCollections = PrCollection::all();
        $colors = Color::all();
        $referer = $request->headers->get('referer');
        session()->put('referer', $referer);
        return view('pr_cvet.edit', compact('prCvet', 'prCollections', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PrCvet $prCvet)
    {
        $request->validate([
            'name_in_folder' => ['required', 'string'],
        ]);

        $name_in_folder = $request->name_in_folder;
        $description = $request->description;
        $pr_collection_id = $request->pr_collection_id;
        $prCollection = PrCollection::find($pr_collection_id);
        if ($prCollection->name || $prCollection->nickname) {
            $collectionName = $prCollection->nickname ?? $prCollection->name;
        } else {
            $collectionName = 'no collection';
        }
        $nameInCollection = $request->name_in_folder;
        $title = "$nameInCollection $collectionName";

        $this->deleteImages($prCvet, $request);
        $this->addImages($prCvet, $request);
        $color_id = $request->color_id;

        $prCvet->fill(compact('name_in_folder', 'description', 'title', 'color_id', 'pr_collection_id'));
        $prCvet->save();

        $referer = session('referer');
        return $referer ?
            redirect($referer)->with('success', 'The product was changed, it is ok!') :
            redirect()->route('pr_cvets.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function delete($id)
    {
        $prCvet = PrCvet::find($id);
        return view('pr_cvet.delete', compact('prCvet'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        PrCvet::destroy($id);
        return redirect()->route('pr_cvets.index')->with('success', 'the product was deleted');
    }

    public function addImages(PrCvet $prCvet, Request $request)
    {
        $has = $request->has('images');
        $hasFile = $request->hasFile('images');
        if (isset($request->images)) {
            $prCvet
                ->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }
    }

    public function deleteImages(PrCvet $prCvet, Request $request)
    {
        $imagesForRemove = $request->images_for_remove;

        if ($imagesForRemove) {
            $mediaItems = $prCvet->images;
            foreach ($imagesForRemove as $name) {
                $mediaItems->firstWhere('name', $name)->delete();
            }
        }
    }

    public function publish(PrCvet $prCvet)
    {
        $prCvet->publish();
        return back();
    }
    public function retract(PrCvet $prCvet)
    {
        $prCvet->retract();
        return back();
    }
}
