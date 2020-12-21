<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list()
    {
        return view('shop.products', ['products' => ProductsService::getProducts()]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function product($slug)
    {
        return view('shop.product', ['product' => ProductsService::getProduct($slug)]);
    }
}
