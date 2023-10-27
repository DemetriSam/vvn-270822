<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteInfoController extends Controller
{
    public function index()
    {
        $records = DB::table('site-info')->get();
        return view('dashboard', compact('records'));
    }

    public function update(Request $request)
    {
        $input = $request->input();
        $update = [];
        foreach ($input as $key => $value) {
            if (starts_with($key, '_')) continue;
            $update[] = compact('key', 'value');
        }
        DB::table('site-info')->upsert(
            $update,
            ['key'],
            ['value']
        );
        return redirect()->back();
    }

    public function create()
    {
        return view('site_info.create');
    }
    public function delete()
    {
        return view('site_info.delete');
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $insert = [];
        foreach ($input as $key => $value) {
            if (starts_with($key, '_')) continue;
            $insert[$key] = $value;
        }
        DB::table('site-info')->insert($insert);
        return redirect()->route('dashboard');
    }

    public function destroy(Request $request)
    {
        $key = $request->key;
        DB::table('site-info')->where('key', $key)->delete();
        return redirect()->route('dashboard');
    }
}
