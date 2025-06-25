<?php

namespace App\Http\Middleware;

use App\Models\token;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateCompanyToken
{


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        dd( $request->bearerToken());

        if (!$request->bearerToken()) {

            abort(400, 'Token is missing from the request.');
        }

        $token = token::where('token', $request->bearerToken())->firstOrFail();

        if (!$token->isActive) {
            abort(404, 'The token is inactive.');
        }

        if ($token->message_quota <= 0) {
            abort(404, 'message quota is 0');
        }

        return $next($request);
    }
}
