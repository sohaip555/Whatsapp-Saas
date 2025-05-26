<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginUserRequest;
use App\Traits\ApiResponses;

class AuthController extends Controller
{
    use ApiResponses;

    /**
     * Handle a login request to the application.
     */
    public function login(LoginUserRequest $request)
    {
            $rememberMe = $request->validate();
        if (auth()->attempt($request->get('email', 'password'))) {
            $user = auth()->user();
            return $this->ok('Login successful', ['user' => $user]);
        }

        return $this->error('Invalid credentials', 401);
    }
}
