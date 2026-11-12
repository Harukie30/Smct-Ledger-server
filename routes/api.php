<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LedgerController;

Route::post('login', [UserController::class, 'login']);

Route::get('profile', function (Request $request) {
        return $request->user()->load(
            [
                'roles' => fn($q) => $q->select(['name'])
            ]
        );
})->middleware('auth:sanctum');

Route::middleware(['auth', 'role:admin'])->group(
    function ()
    {
        Route::get('locations/selections', [LocationController::class, 'index2']);
        Route::get('SOs/selections', [InstallmentController::class, 'index2']);
    }
);

Route::middleware('auth:sanctum')->group(
    function ()
    {
        Route::controller(PaymentController::class)->group(
            function () {
                Route::patch('payments/{payment}/void','toVoid');
            }
        );

        Route::apiResource('users', UserController::class);
        Route::apiResource('installments', InstallmentController::class);
        Route::apiResource('logs', LogController::class);
        Route::apiResource('locations', LocationController::class);
        Route::apiResource('payments', PaymentController::class);
        Route::get('ledger/{installment}', [LedgerController::class, 'show']);

        Route::post('logout', [UserController::class , 'logout']);
    }
);

