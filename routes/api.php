<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TenantAccessController;
use App\Http\Controllers\Api\V1\TenantController;
use App\Http\Middleware\EnsureTenantAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request;
});


//Route::apiResource('tenant', TenantController::class)->middleware(EnsureTenantAuthenticated::class);

//Route::post('tenant/login', [TenantAccessController::class, 'login']);
