<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\TransactionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('user')->group(function(){
        Route::get('/{id}', function (Request $request) {

            $user = $request->user()->with(['subscriptions','transactions'])->first();
            /*foreach ($user->subscriptions as $subscription) {
                $subscription->expired_at = $subscription->pivot->expired_at;
                $subscription->renewed_at = $subscription->pivot->renewed_at;
            }*/
            return $user;
        });
        Route::post('/{id}/subscription', [SubscriptionController::class, 'store']);
        Route::put('/{id}/subscription/{subscription_id}', [SubscriptionController::class, 'update']);
        Route::delete('/{id}/subscription', [SubscriptionController::class, 'destroy']);
        Route::post('/{id}/transaction', [TransactionsController::class, 'store']);
    });

});


