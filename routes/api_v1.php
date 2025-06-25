<?php

use App\Http\Controllers\Api\V1\TenantController;
use App\Http\Middleware\ValidateCompanyToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//    Route::apiResource('users', UserController::class)->except(['update']);

//Route::apiResource('tenant', TenantController::class)->middleware(ValidateCompanyToken::class);
Route::post('messages/send', [TenantController::class, 'sendMessage'])->middleware(ValidateCompanyToken::class);

Route::post('messages/bulk-send', [TenantController::class, 'bulkSend'])->middleware(ValidateCompanyToken::class);
