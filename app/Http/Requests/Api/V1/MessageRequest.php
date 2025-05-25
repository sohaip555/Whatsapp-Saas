<?php

namespace App\Http\Requests\Api\V1;

class MessageRequest extends BaseMessageRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            [
                'data.attributes.message' => 'required|string|max:255',
                'data.attributes.sendingNumber' => 'required|string|max:255',
                'data.attributes.receivingNumber' => 'required|string|max:255',
//                'data.relationships.token.data.id' => 'required|exists:token,id',
            ]
        ];
    }
}
