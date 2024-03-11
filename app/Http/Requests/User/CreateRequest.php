<?php

namespace App\Http\Requests\User;

use App\Enums\Role;
use App\Http\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => ['required', 'in:' . Role::APPLICANT->value . ',' . Role::EMPLOYER->value],
            'password' => 'sometimes|confirmed'
        ];
    }
}
