<?php

use App\Http\Controllers\MemberIndexController;
use App\Http\Controllers\PaymentIndexController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\PaymentSuccessController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/members', MemberIndexController::class)->middleware('member');

//payment route
Route::get('/payment', PaymentIndexController::class)->middleware(['auth', 'not-member']);
Route::post('/payments/success', PaymentSuccessController::class)->middleware('auth');

Route::post('/webhooks/stripe', StripeWebhookController::class)->middleware('stripe-webhook-header');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
