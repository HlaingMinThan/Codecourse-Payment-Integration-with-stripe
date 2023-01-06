<?php

return [
    'key' => env('STRIPE_CLIENT_KEY'), //client key for frontend,
    'secret' => env('STRIPE_SECRET_KEY'), //backend key for frontend
    'webhook_secret' => env('STRIPE_WEBHOOK_SECRET') //backend key for frontend
];
