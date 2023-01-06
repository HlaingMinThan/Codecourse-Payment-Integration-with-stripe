<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentIndexController extends Controller
{
    public function __invoke()
    {
        //1 - if payment intent exists -> use it, if not, create a payment intent and store in the session
        if (session()->has('payment_intent_id')) {
            $paymentIntent = app('stripe')->paymentIntents->retrieve(session()->get('payment_intent_id'));
        } else {
            $paymentIntent = app('stripe')->paymentIntents->create([
                'amount' => 10000, //100 usd
                'currency' => 'usd',
                'setup_future_usage' => 'on_session',
                'metadata' => [
                    'user_id' => auth()->user()->id
                ]
            ]);
            session()->put('payment_intent_id', $paymentIntent->id);
        }

        return view('payments', [
            'payment_intent' => $paymentIntent
        ]);
    }
}
