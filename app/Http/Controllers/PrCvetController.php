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
        $cvets = PrCvet::all();
        return view('pr_cvet.index', compact('cvets'));
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

        $pr_cvet = \App\Models\PrCvet::create([
            'title' => $request->title,
            'description' => $request->description,
            'pr_collection_id' => $request->pr_collection_id,
        ]);

        $images = $request->file('images');

        if ($request->hasFile('images')) {
            foreach ($images as $image) {
                $path = $image->store('pr_cvet_images');
                $pr_image = \App\Models\PrImage::create([
                    'orig_img' => $path,
                    'imageable_id' => $pr_cvet->id,
                    'imageable_type' => \App\Models\PrCvet::class,
                ]);

                $pr_image->makeResizes($pr_cvet);
                $pr_image->save();
            }
        }



        return redirect()->route('pr_cvet.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $pr_cvet = PrCvet::find($id);
        return view('pr_cvet.show', compact('pr_cvet'));
    }
}
