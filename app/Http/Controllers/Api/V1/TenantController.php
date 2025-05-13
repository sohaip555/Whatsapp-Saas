<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\MessageManagementRequest;
use App\Models\MessageManagement;
use App\Models\Tenant;
use App\Models\TenantSubscriptionLog;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Send a message for a tenant.
     */
    public function sendMessage(MessageManagementRequest $request)
    {

        $MessageManagement = MessageManagement::where('token', $request->bearerToken())->firstOrFail();

        // Check tenant's message balance
        if ($MessageManagement->message_quota <= 0) {
            return response()->json(['error' => 'Insufficient message balance'], 400);
        }

        // Decrease the message balance
        $MessageManagement->message_quota -= 1;
        $MessageManagement->save();

        // Logic to send a message (e.g., via email or SMS may be added here)
        return response()->json([
            'success' => 'Message sent successfully',
            'phone_number' => $request->phone_number,
            'message quota' => $MessageManagement->message_quota,
            ], 200);
    }


}
