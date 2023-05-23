<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function title()
    {
        return view('tests.title', ['title' => 'тайтл']);
    }
}
