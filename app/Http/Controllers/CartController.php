<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        Cart::session(Auth::id());
        return view('shop.cart', [
            'products' => Cart::getContent(),
            'total' => Cart::getTotal(),
        ]);
    }

    /**
     * @param string $pid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(string $pid)
    {
        $product = ProductsService::getProduct($pid);

        Cart::session(Auth::id())->add(
            [
                'id' => $product->_id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array(),
                //'associatedModel' => $product,
            ]
        );

        return redirect()->route('cart.show');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emptyCart()
    {
        Cart::session(Auth::id());
        Cart::clear();

        return redirect()->route('shop');
    }
}
