<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\MessageRequest;
use App\Models\messages;
use App\Models\token;
use App\Traits\ApiResponses;

class TenantController extends Controller
{
    use ApiResponses;
    /**
     * Send a message for a tenant.
     */
    public function sendMessage(MessageRequest $request)
    {
        $message = $request->mappedAttributes();


//        dd($message);
        $message = messages::sendMessage($message, $request->bearerToken());
        if (!$message){
            return $this->error(['error' => 'Insufficient message balance'], 400);
        }

        // Logic to send a message (e.g., via email or SMS may be added here)
        return $this->ok(
            'Message sent successfully',
            [
            'sending_number' => $message->sending_number,
            'receiving_number' => $message->receiving_number,
            'message quota' => $message->token->message_quota,
            ]);
    }


    public function bulkSend()
    {
        
    }    


}
