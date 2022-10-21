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

        $pr_cvet
            ->addMediaFromRequest('images')
            ->toMediaCollection();

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
        $pr_cvet = PrCvet::find($id);
        return view('pr_cvet.show', compact('pr_cvet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $pr_cvet = PrCvet::find($id);
        return view('pr_cvet.edit', compact('pr_cvet'));
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
        $pr_cvet = PrCvet::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        $name = $request->name;
        $pr_cvet_id = $request->pr_cvet_id;
        $pr_cvet->fill(compact('name', 'pr_cvet_id'));
        $pr_cvet->save();

        return redirect()->route('categories.index');
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
        return redirect()->route('categories.index');
    }
}
