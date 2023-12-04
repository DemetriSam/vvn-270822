<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Page;
use App\Models\Post;
use App\Models\PrCollection;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Services\Pages\PageBuilderFactory;
use App\Services\TextFormat\IdTagger;
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
        $pages = Page::all()->sort();
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
        $id = Page::create($input)->id;
        if ($input['type'] === 'blog') {
            Post::create(['page_id' => $id]);
        }
        return redirect()->route('pages.edit', ['page' => $id])->with('success', 'New page was created');
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
        $user = $request->user();
        $notAdmin = !optional($user)->hasRole('admin');
        $notPublished = $page->published !== 'true';
        if ($notPublished && $notAdmin) return redirect('/');

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
        $input['published'] = $input['published'] ?? 'false';

        if ($input['text-content'] ?? false) {
            $tagger = new IdTagger;
            $tagger->setHtml($input['text-content']);
            $input['text-content'] = $tagger->format();
        }

        $page->fill($input);
        $page->save();

        if (isset($page->post)) {
            $post = $page->post;
            $post->ann = $input['ann'];
            $post->published = $input['published'];
            $post->save();

            if (isset($request->image)) {
                $mediaItem = $post
                    ->getMedia('blog')
                    ->each(fn ($mediaItem) => $mediaItem->delete());
                $post->addMediaFromRequest('image')->withResponsiveImages()->toMediaCollection('blog');
            }
        }

        return redirect()->route('pages.index')->with('success', 'Page was updated');
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

    public function storepic(Request $request, Page $page)
    {
        $url = $page
            ->addAllMediaFromRequest()->first()->withResponsiveImages()
            ->toMediaCollection('images')
            ->getUrl('widthOfArticleColumn');

        return json_encode(compact('url'));
    }

    public function publish(Page $page)
    {
        $page->publish();
        if (isset($page->post)) {
            $page->post->publish();
        }
        return back();
    }
    public function retract(Page $page)
    {
        $page->retract();
        if (isset($page->post)) {
            $page->post->retract();
        }
        return back();
    }
}
