<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseBulkSendRequest extends FormRequest
{
    public function mappedAttributes($otherAttributes = [])
    {
        $attributeMap = array_merge([
            'data.attributes.message' => 'message',
            'data.attributes.sendingNumber' => 'sending_number',
            'data.attributes.receivingNumbers' => 'receiving_numbers', // ← note plural
            'data.attributes.createdAt' => 'created_at',
            'data.attributes.updatedAt' => 'updated_at',
        ], $otherAttributes);

        $attributesToUpdate = [];

        foreach ($attributeMap as $key => $attribute) {
            if ($this->has($key)) {
                $attributesToUpdate[$attribute] = $this->input($key);
            }
        }

        return $attributesToUpdate;
    }

    public function rules(): array
    {
        return [
            'data.attributes.message' => ['required', 'string'],
            'data.attributes.sendingNumber' => ['required', 'string'],
            'data.attributes.receivingNumbers' => ['required', 'array', 'min:1'],
            'data.attributes.receivingNumbers.*' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'data.attributes.message.required' => 'The message content is required.',
            'data.attributes.sendingNumber.required' => 'The sending number is required.',
            'data.attributes.receivingNumbers.required' => 'At least one recipient number is required.',
            'data.attributes.receivingNumbers.array' => 'Receiving numbers must be an array.',
            'data.attributes.receivingNumbers.*.required' => 'Each recipient number must be provided.',
        ];
    }
}
