<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class StripeWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        $method = 'handle' . Str::studly(str_replace('.', '_', $payload['type']));

        //call the webhook type method dynamically
        if (method_exists($this, $method)) {
            return $this->$method($payload);
        }
    }


    public function handlePaymentIntentSucceeded($payload)
    {
        //get a user
        $user = User::findOrFail(Arr::get($payload, 'data.object.metadata.user_id'));
        //update member status to true
        return $user->update([
            'member' => true
        ]);
    }
}
