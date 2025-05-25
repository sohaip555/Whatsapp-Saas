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


    public static function sendMessage(array $message,  $bearerToken)
    {
//        dd($message);
        $tokens = token::where('token', $bearerToken)->firstOrFail();

//            dd($tokens);

        $tokens->message_quota -= 1;
        $tokens->save();

        $message['token_id'] = $tokens->id;

        $message = messages::create($message);

        return $message;
    }

}
