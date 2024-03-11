<?php

namespace App\Http\Requests;


class AdvertisementSaveRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'advertisement_id' => [
                'required', 'exists:advertisements,id'
            ]
        ];
    }
}
