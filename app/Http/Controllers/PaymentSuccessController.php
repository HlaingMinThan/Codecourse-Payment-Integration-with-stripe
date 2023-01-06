<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentSuccessController extends Controller
{
    public function __invoke()
    {
        return redirect('/dashboard')->with('status', 'Payment Accepted Successfully');
    }
}
