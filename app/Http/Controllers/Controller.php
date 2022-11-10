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

    /**
     * Каталог с ковровыми покрытиями
     *
     * @return \Illuminate\View\View
     */
    public function carpets()
    {
        $type = 'carpets';
        $products = [];
        return view('catalog', compact('type', 'products'));
    }

    /**
     * Каталог с циновками
     *
     * @return \Illuminate\View\View
     */
    public function cinovki()
    {
        $type = 'cinovki';
        $products = [];
        return view('catalog', compact('type', 'products'));
    }


    /**
     * Главная страница
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Страница избранного
     *
     * @return \Illuminate\View\View
     */
    public function favorites()
    {
        return view('favorites');
    }
}
