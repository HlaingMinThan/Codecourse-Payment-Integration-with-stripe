<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stripe\Exception\SignatureVerificationException;
use Stripe\WebhookSignature;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class StripeWebhookHeaderCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            WebhookSignature::verifyHeader($request->getContent(), $request->header('stripe-signature'), config('stripe.webhook_secret'));
            return $next($request);
        } catch (SignatureVerificationException $e) {
            throw new AccessDeniedHttpException($e->getMessage(), $e);
        }
    }
}
