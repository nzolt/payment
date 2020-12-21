<?php


namespace App\Services\Payment\Stripe;


use App\Models\Order;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class StripeService
{
    public static function createCustomer()
    {
        $user = Auth::user();
        if($user->stripe_id == '') {
            $stripe = self::getStripe();

            $total = Cart::getTotal();
            $customer = $stripe->customers()->create([
                'email' => $user->email,
                'name' => $user->name,
            ]);

            $user->stripe_id = $customer['id'];
        }
        return $user->stripe_id;
    }

    public static function createPaymentMethod(Order $order, Request $request)
    {
        $user = Auth::user();
        $stripe = self::getStripe();
        $paymentMethod = $stripe->paymentMethods()->create([
            'type' => 'card',
            'card' => [
                'number' => $request->get('cardNumber'),
                'exp_month' => $request->get('cardExpiryMonth'),
                'exp_year' => $request->get('cardExpiryYear'),
                'cvc' => $request->get('cardCvc')
            ],
        ]);
        $order->paymentMethodId = $paymentMethod['id'];
        if($paymentMethod){
            $paymentMethod = $stripe->paymentMethods()->attach($order->paymentMethodId, $user->stripe_id);
            $paymentMethod = $stripe->paymentMethods()->update($order->paymentMethodId, [
                'metadata' => [
                    'order_id' => $order->_id,
                ],
            ]);
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->get('cardNumber'),
                    'exp_month' => $request->get('cardExpiryMonth'),
                    'exp_year' => $request->get('cardExpiryYear'),
                    'cvc' => $request->get('cardCvc')
                ],
            ]);

            $card = $stripe->cards()->create($user->stripe_id, $token['id']);
            $order->stripeCardId = $card['id'];
            $order->save();

            return true;
        }

        return false;
    }

    public static function createPaymentIntent(Order $order)
    {
        $stripe = self::getStripe();
        $paymentIntent = $stripe->paymentIntents()->create([
            'amount' => $order->getTotal() * 100,
            'currency' => 'gbp',
            'payment_method_types' => [
                'card',
            ],
        ]);

        if($paymentIntent['id']) {
            $paymentIntent = $stripe->paymentIntents()->update($paymentIntent['id'], [
                'metadata' => [
                    'order_id' => $order->_id,
                ],
            ]);
            if($paymentIntent['id']){
                $order->paymentIntent = $paymentIntent['id'];
                $order->save();
            }

            return true;
        }

        return false;
    }

    public static function makePayment(string $stripeId, Order $order)
    {
        $stripe = self::getStripe();
        $charge = $stripe->charges()->create([
            'customer' => $stripeId,
            'currency' => 'GBP',
            'amount'   => $order->getTotal(),
        ]);
        /*if(!array_key_exists('id', $charge){
            $charge = $stripe->charges()->capture($charge['id']);
        }*/

        if($charge['id']){
            $order->paymentReference = $charge['id'];
            $order->save();

            return true;
        }

        return false;
    }

    public static function getStripe()
    {
        return Stripe::make(config('services.stripe.secret'));
    }
}
