<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function carpets()
    {
        $type = 'carpets';
        $products = [];
        return view('catalog', compact('type', 'products'));
    }

    public function cinovki()
    {
        $type = 'cinovki';
        $products = [];
        return view('catalog', compact('type', 'products'));
    }

    public function index()
    {
        return view('index');
    }

    public function favorites()
    {
        return view('favorites');
    }
}
