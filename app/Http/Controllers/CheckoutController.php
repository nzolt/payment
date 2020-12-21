<?php

namespace App\Http\Controllers;

use App\Models\InvoiceIds;
use App\Services\Payment\Stripe\StripeService;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Stripe;
use App\Models\Order;
use App\Services\Payment\Invoice\InvoiceService;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function checkout()
    {
        Cart::session(Auth::id());
        $user = Auth::user();
        $products = Cart::getContent();
        $total = Cart::getTotal();

        return view('shop.checkout', ['total' => number_format($total, 2)]);
    }

    /**
     * @param Request $request
     * @param string $orderId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function checkoutSuccess(Request $request, string $orderId)
    {
        $order = Order::find($orderId);
        if($order->invoiceNo != ''){
            $title = 'Payment successful';
            $button = 'Download invoice';
        } else {
            $title = 'Payment pending';
            $button = 'Download proforma invoice';
        }
        return view('shop.success', ['orderId' => $orderId, 'title' => $title, 'button' => $button]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function pay(Request $request): RedirectResponse
    {
        $stripe = Stripe::make(config('services.stripe.secret'));
        Cart::session(Auth::id());
        $products = Cart::getContent();
        $items = [];
        foreach($products as $product){
            array_push($items, [
                'Id' => $product->id,
                'Name' => $product->name,
                'Quantity' => $product->quantity,
                'Price' => $product->price,
            ]);
        }

        $total = Cart::getTotal();
        $order = new Order();
        $order->customerId = Auth::id();
        $order->fill(
            [
                'customerId' => Auth::id(),
                'date' => time(),
                'paymentMethodId' => '',
                'paymentReference' => '',
                'items' => $items,
                'price' => $total,
                'info' => 'Payment: STRIPE'
            ]
        );
        $order->save();
        $user = Auth::user();
        $total = Cart::getTotal();
        if($request->get('type') == 'card') {
            StripeService::createCustomer();

            if ($user->stripe_id != '') {
                if (StripeService::createPaymentMethod($order, $request)) {
                    if (StripeService::createPaymentIntent($order)) {
                        $payment = StripeService::makePayment($user->stripe_id, $order);
                    }
                }
                $invoiceNo = new InvoiceIds();
                $order->invoiceNo = $invoiceNo;
                $order->save;
                $invoiceNo->order_id = $order->_id;
                $invoiceNo->save();
                $invoice = InvoiceService::createInvoice($items, $invoiceNo->id);

            }
        } else {
            $order->invoiceNo = '';
            $order->paymentIntent = '';
            $order->paymentReference = '';
            $order->info = 'Payment: TRANSFER';
            $order->save;
        }
        Cart::clear();

        return redirect()->route('checkout.success', $order->_id);
    }

    /**
     * @param Request $request
     * @param string $orderId
     */
    public function getInvoice(Request $request, string $orderId)
    {
        $order = Order::find($orderId);
        if($order->invoiceNo == null || $order->invoiceNo == ''){
            $invoiceNo = InvoiceIds::where('order_id', '=', $orderId)->first();
            if($invoiceNo == null){
                if($order->invoiceNo != '' &&
                $order->paymentIntent != '' &&
                $order->paymentReference != '') {
                    $invoiceNo = new InvoiceIds();
                    $invoiceNo->order_id = $order->_id;
                    $invoiceNo->save();
                }
            } else {
                $order->invoiceNo = $invoiceNo->id;
                $order->save();
            }
        }
        if($order->customerId == null){
            $order->customerId = 1;
            $order->save();
        }

        $invoice = InvoiceService::generateInvoice($order->items, (int)$order->invoiceNo, $order->customerId);

    }
}
