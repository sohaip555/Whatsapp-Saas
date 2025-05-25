<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'message',
            'id' => $this->id,
            'attributes' => [
                'message' => $this->message,
                'sendingNumber' => $this->sending_number,
                'receivingNumber' => $this->receiving_number,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'relationships' => [
                'token' => [
                    'data' => [
                        'type' => 'token',
                        'id' => $this->token_id,
                    ],
//                    'links' => [
//                        'self' => route('token.show', ['token' => $this->tokens_id]),
//                    ]
                ],
            ],
            'includes' => $this->whenLoaded('token'),
//            'links' => [
//                'self' => route('messages.show', ['message' => $this->id]),
//            ],
        ];

    }
}
