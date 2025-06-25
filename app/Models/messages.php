<?php

namespace App\Models;

use Database\Factories\MessagesFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    /** @use HasFactory<MessagesFactory> */
    use HasFactory;

    protected $guarded = [];

    public function token(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(token::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public static function sendMessage(array $message,  $bearerToken)
    {
        $tokens = token::where('token', $bearerToken)->firstOrFail();

        $message['token_id'] = $tokens->id;
        $message['company_id'] = $tokens->company->id;
        $message = messages::create($message);

        $tokens->message_quota -= 1;
        $tokens->save();

        return $message;
    }

    public static function BulkMessages(array $message, $bearerToken)
    {
        $receiving_numbers = [];
        $tokens = token::where('token', $bearerToken)->firstOrFail();

        foreach ($message['receiving_numbers'] as $number) {



            $receiving_numbers [] = $number;

            messages::create([
                'message' =>  $message['message'],
                'token_id' => $tokens->id,
                'company_id' => $tokens->company->id,
                'sending_number' =>  $message['sending_number'],
                'receiving_number' => $number,

            ]);
        }

        $tokens->message_quota -= collect($receiving_numbers)->count();
        $tokens->save();

        return [
            'sending number' => $message['sending_number'],
            'message quota' => collect($receiving_numbers)->count(),
            'receiving numbers' => $receiving_numbers
        ];

    }

}
