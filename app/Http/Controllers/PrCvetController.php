<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrCvet;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PrCvetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pr_cvets = PrCvet::all();
        return view('pr_cvet.index', compact('pr_cvets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pr_cvet.create');
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
            'title' => ['required', 'string'],
        ]);

        $prCvet = \App\Models\PrCvet::create([
            'title' => $request->title,
            'description' => $request->description,
            'pr_collection_id' => $request->pr_collection_id,
        ]);

        $this->addImages($request);


        return redirect()->route('pr_cvets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $prCvet = PrCvet::find($id);
        $images = $prCvet->getMedia('images');
        return view('pr_cvet.show', compact('prCvet', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $prCvet = PrCvet::find($id);
        return view('pr_cvet.edit', compact('prCvet'));
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
        $prCvet = PrCvet::findOrFail($id);
        $request->validate([
            'title' => ['required', 'string'],
        ]);

        $title = $request->title;
        $description = $request->description;

        $this->deleteImages($prCvet, $request);
        $this->addImages($prCvet, $request);

        $prCvet->fill(compact('title', 'description'));
        $prCvet->save();

        return redirect()->route('pr_cvets.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function delete($id)
    {
        $pr_cvet = PrCvet::find($id);
        return view('pr_cvet.delete', compact('pr_cvet'));
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
        return redirect()->route('pr_cvets.index');
    }

    public function addImages(PrCvet $prCvet, Request $request)
    {
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
            $mediaItems = $prCvet->getMedia('images');
            foreach ($imagesForRemove as $name) {
                $mediaItems->firstWhere('name', $name)->delete();
            }
        }
    }
}
