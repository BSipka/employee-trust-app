<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class AdvertisementApplyRequest extends BaseRequest
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
                'required', 'exists:advertisements,id', Rule::unique('advertisement_user')
                    ->where('advertisement_id', $this->advertisement_id)->where('user_id', $this->user()->id)
            ]
        ];
    }

    public function messages()
    {
        return [
            'advertisement_id.unique' => 'Already applied'
        ];
    }
}
