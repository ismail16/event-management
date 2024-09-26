<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        info('', [$this]);
        return [
            'name'           => ['required', 'max:255'],
            'email'          => ['required', 'email',],
            'phone'          => ['required', 'max:11'],
            'batch'          => ['required', 'integer', 'between:1,63'],
            'cadet_number'   => [ 'integer', 'between:1,3200'],
            'address'        => [ 'max:255'],
            'house'          => ['sometimes'],
            'marital_status' => ['required'],
            'tshirt_size'    => ['sometimes'],
            'guests'         => ['sometimes', 'array']
        ];
    }
}
