<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|min:3|max:255',
            'last_name'  => 'required|min:3|max:255',
            'email'      => 'required|email:rfc,dns|unique:users,email,'.$this->id,
            'password'   => ['required'],
            'role'       => 'required|string',
            'phone'      => 'required|regex:/^01[3-9]\d{8}$/',
            'events'     => ['sometimes', 'required', 'array']
        ];

        if (($this->id) && blank($this->password)) {
            unset($rules['password']);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'email'    => 'Please input valid & operational e-mail address Only! We are checking DNS too',
            'password' => 'Password should be minimum 6 character with symbols, letters & numbers',
        ];
    }
}
