<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filter' => ['sometimes', 'nullable'],
            'q'      => ['sometimes', 'nullable']
        ];
    }
}
