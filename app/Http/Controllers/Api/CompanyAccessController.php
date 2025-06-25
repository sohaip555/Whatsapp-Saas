<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyAccessRequest;
use App\Models\Company;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;

class CompanyAccessController extends Controller
{
    use ApiResponses;

    /**
     * Handle a login request to the application.
     */
    public function login(CompanyAccessRequest $request)
    {
//        dd();
        $request->validated($request->all());


        if (!Auth::guard('Company')->attempt($request->only( 'email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }


        $company = Company::query()->findOrFail($request->email);
//        dd();

        return $this->ok('Login successful', ['Company' => $company]);

    }
}
