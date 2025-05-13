<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantAccessRequest;
use App\Models\Tenant;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;

class TenantAccessController extends Controller
{
    use ApiResponses;

    /**
     * Handle a login request to the application.
     */
    public function login(TenantAccessRequest $request)
    {
//        dd();
        $request->validated($request->all());


        if (!Auth::guard('tenant')->attempt($request->only( 'email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }


        $tenant = Tenant::query()->findOrFail($request->email);
//        dd();

        return $this->ok('Login successful', ['tenant' => $tenant]);

    }
}
