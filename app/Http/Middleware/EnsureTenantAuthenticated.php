<?php

namespace App\Http\Middleware;

use App\Models\token;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantAuthenticated
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
//        dd($token);

        $tenantSubscriptionLog = $token->tenantSubscriptionLog;

        if (!$tenantSubscriptionLog) {
            abort(404, 'Tenant subscription log not found for the given token.');
        }

        if ($token->message_quota <= 0) {
            abort(404, 'message quota is 0');
        }

        return $next($request);
    }
}
