<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\MessageManagementRequest;
use App\Models\messages;
use App\Models\tokens;
use App\Models\Tenant;
use App\Models\TenantSubscriptionLog;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    use ApiResponses;
    /**
     * Send a message for a tenant.
     */
    public function sendMessage(MessageManagementRequest $request)
    {

        $MessageManagement = tokens::where('token', $request->bearerToken())->firstOrFail();

        // Check tenant's message balance
        if ($MessageManagement->message_quota <= 0) {
            return $this->error(['error' => 'Insufficient message balance'], 400);
        }

        // Decrease the message balance
        $MessageManagement->message_quota -= 1;
        $MessageManagement->save();


        messages::create([
            'tokens_id' => $MessageManagement->id,
            'message' => $request->message,
            'sending_number' => $request->sending_number,
            'receiving_number' =>$request->receiving_number,
        ]);

        // Logic to send a message (e.g., via email or SMS may be added here)
        return $this->ok(
            'Message sent successfully',
            [
            'sending_number' => $request->sending_number,
            'receiving_number' => $request->receiving_number,
            'message quota' => $MessageManagement->message_quota,
            ], 200);
    }


}
