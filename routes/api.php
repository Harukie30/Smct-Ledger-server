<?php

use App\Http\Controllers\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('login', [UserController::class, 'login']);

Route::get('/profile', function (Request $request) {
        return $request->user()->load(
            [
                'roles' => fn($q) => $q->select(['name'])
            ]
        );
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(
    function () {

        // Route::controller(UserController::class)->group(
        //     function () {

        //     }
        // );

        Route::apiResource('users', UserController::class);

         Route::post('logout', function (Request $request)
        {
            Auth::guard("web")->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(
                [
                    'message' => 'Logged out successfully'
                ]
                ,200
            );
        });
    }
);

