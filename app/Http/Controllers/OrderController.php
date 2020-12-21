<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list(Request $request)
    {
        $orders = Order::where('customerId', '=', Auth::id())->get();
        //$orders = Order::all();
        foreach ($orders as $order) {
            $order->date = date('Y-m-d H:i', $order->date);
            $order->price = number_format($order->price, 2);
            if($order->invoiceNo != ''){
                $order->button = 'Download invoice';
            } else {
                $order->button = 'Download proforma invoice';
            }
        }

        return view('shop.orders', ['title' => 'Title', 'orders' => $orders]);
    }
}
