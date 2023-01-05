<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentIndexController extends Controller
{
    public function __invoke()
    {
        //1 - create a payment intent

        $paymentIntent = app('stripe')->paymentIntents->create([
            'amount' => 10000, //100 usd
            'currency' => 'usd',
            'setup_future_usage' => 'on_session',
            'metadata' => [
                'user_id' => auth()->user()->id
            ]
        ]);

        return view('payments');
    }
}
