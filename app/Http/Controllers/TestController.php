<?php

namespace App\Http\Controllers;

use App\Services\Tags\Title;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function title(Title $titleBuiler)
    {
        return view('tests.title', ['title' => $titleBuiler->getTag()]);
    }
}
