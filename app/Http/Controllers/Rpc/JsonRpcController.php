<?php

namespace App\Http\Controllers\Rpc;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\ProductsService;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use AvtoDev\JsonRpc\Requests\RequestInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\Rpc;

class JsonRpcController extends Controller
{
    /**
     * Get sum of array.
     *
     * @param RequestInterface $request
     *
     * @return mixed[]
     */
    public function _sum(RequestInterface $request): array
    {
        $res = null;
        $params = $request->getParams();
        if(property_exists($params, 'res')){
            $res = $params->res;
        }
        return Rpc\ArrayResource::arraySum($params->nrs, $res);
    }

    /**
     * Get info from request.
     *
     * @param RequestInterface $request
     *
     * @return mixed[]
     */
    public function _showInfo(RequestInterface $request): array
    {
        return Rpc\DetailResource::getRequestData($request);
    }

    /**
     * @param RequestInterface $request
     * @return Collection
     */
    public function _list(RequestInterface $request): Collection
    {
        return ProductsService::getProducts();
    }

    public function _byId(RequestInterface $request): ?Product
    {
        $params = $request->getParams();
        if(property_exists($params, '_id')){
            return ProductsService::getProduct($params->_id);
        }
    }

    public function _cart(RequestInterface $request)
    {
        $params = $request->getParams();
        if(property_exists($params, '_userId')){
            var_dump($params->_userId, 'XXX');
            Cart::session($params->_userId);
            //return Cart::getContent();
            foreach(Cart::getContent() as $item) {
                var_dump($params->_userId, Cart::getContent());
            }

        }
    }

    public function _orders(RequestInterface $request)
    {
        return Order::all();
    }
}
