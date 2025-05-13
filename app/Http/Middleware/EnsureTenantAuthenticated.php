<?php

namespace App\Http\Middleware;

use App\Models\MessageManagement;
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

        // البحث عن السجل بناءً على قيمة التوكن
        $messageManagement = MessageManagement::where('token', $request->bearerToken())->firstOrFail();

        // التحقق من العلاقة (tenant_subscription_log)
        $tenantSubscriptionLog = $messageManagement->tenant_subscription_log;

        if (!$tenantSubscriptionLog) {
            abort(404, 'Tenant subscription log not found for the given token.');
        }

        return $next($request);
    }
}
