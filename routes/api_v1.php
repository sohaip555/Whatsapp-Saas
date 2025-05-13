<?php

use App\Http\Controllers\Api\V1\TenantController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Middleware\EnsureTenantAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//    Route::apiResource('users', UserController::class)->except(['update']);

//Route::apiResource('tenant', TenantController::class)->middleware(EnsureTenantAuthenticated::class);
Route::post('messages/send', [TenantController::class, 'sendMessage'])->middleware(EnsureTenantAuthenticated::class);

