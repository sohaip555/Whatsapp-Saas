<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\BulkSendRequest;
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


        $message = messages::sendMessage($request->mappedAttributes(), $request->bearerToken());
//        dd($message);
        if (!$message){
            return $this->error(['error' => 'Insufficient message balance'], 400);
        }

        // Logic to send a message (e.g., via email or SMS may be added here)
        return $this->ok(
            'Message sent successfully',
            [
            'sending number' => $message->sending_number,
            'receiving number' => $message->receiving_number,
            'message quota' => $message->token->message_quota,
            ]);
    }


    public function bulkSend(BulkSendRequest $request)
    {
        $message = $request->mappedAttributes();


        $response = messages::BulkMessages($message, $request->bearerToken());

        return $this->ok(
            'Message sent successfully',
            $response,
            );

    }


}
