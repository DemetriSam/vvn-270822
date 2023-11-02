<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Page;
use App\Models\PrCollection;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Services\Pages\EloqPageReader;
use App\Services\Pages\PageBuilder;
use App\Services\Pages\PageBuilderFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('page.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prCollections = PrCollection::all();
        $colors = Color::all();
        $properties = Property::all();
        $values = PropertyValue::all();
        $propFilters = $properties->map(function ($property) use ($values) {
            $options = $values->filter(fn ($value) => $value->property_id === $property->id);
            return (object) ['property' => $property, 'options' => $options];
        });
        $pageType = FacadesRequest::input('type');
        return view('page.create', compact('prCollections', 'colors', 'propFilters', 'pageType'));
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
            'name' => 'required|unique:pages',
            'slug' => 'required|unique:pages',
            'title' => 'required',
            'name' => 'required',
        ]);
        $input = $request->input();
        $input['params'] = json_encode([
            'listing' => 'pr_cvets',
            'filter' => isset($input['filter']) ? $input['filter'] : [],
        ]);
        Page::create($input);
        return redirect()->route('pages.index')->with('success', 'New page was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @param  \App\Services\Pages\PageBuilder  $pageBuilder
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Page $page, PageBuilderFactory $factory)
    {
        $factory->addData(['pageN' => $request->pageN]);
        $pageBuilder = $factory->getPageBuilder($page);
        return $pageBuilder->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $prCollections = PrCollection::all();
        $colors = Color::all();
        $properties = Property::all();
        $values = PropertyValue::all();
        $propFilters = $properties->map(function ($property) use ($values) {
            $options = $values->filter(fn ($value) => $value->property_id === $property->id);
            return (object) ['property' => $property, 'options' => $options];
        });
        $pageType = $page->type;
        return view('page.edit', compact('page', 'prCollections', 'colors', 'propFilters', 'pageType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('pages')->ignore($page->id),
            ],
            'slug' => [
                'required',
                Rule::unique('pages')->ignore($page->id),
            ],
            'title' => 'required',
            'name' => 'required',
        ]);

        $input = $request->input();
        $input['params'] = json_encode([
            'listing' => 'pr_cvets',
            'filter' => isset($input['filter']) ? $input['filter'] : [],
        ]);
        $page->fill($input);
        $page->save();
        return back()->with('success', 'Page was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
