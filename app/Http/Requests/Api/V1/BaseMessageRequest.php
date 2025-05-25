<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseMessageRequest extends FormRequest
{
    /**
     * تحويل البيانات من JSON:API format إلى format مفهوم بالنسبة للـ model.
     */
    public function mappedAttributes($otherAttributes = [])
    {
        $attributeMap = array_merge([
            'data.attributes.message' => 'message',
            'data.attributes.sendingNumber' => 'sending_number',
            'data.attributes.receivingNumber' => 'receiving_number',
            'data.attributes.createdAt' => 'created_at',
            'data.attributes.updatedAt' => 'updated_at',
//            'data.relationships.token.data.token' => 'token',
        ], $otherAttributes);

//        dd($attributeMap);

        $attributesToUpdate = [];

        foreach ($attributeMap as $key => $attribute) {
            if ($this->has($key)) {
                $attributesToUpdate[$attribute] = $this->input($key);
            }
        }

//        dd($attributesToUpdate);

        return $attributesToUpdate;
    }

    public function messages()
    {
        return [
            'data.attributes.message.required' => 'The message content is required.',
            'data.attributes.sendingNumber.required' => 'The sending number is required.',
            'data.attributes.receivingNumber.required' => 'The receiving number is required.',
//            'data.relationships.token.data.id.required' => 'Token ID is required.',
//            'data.relationships.token.data.id.exists' => 'The selected token does not exist.',
        ];
    }
}
