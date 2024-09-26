<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'venue' => ['required', 'max:255'],
            'email' => ['required','email:rfc,dns'],
            'phone' => ['required'],
            'event_start_date' => ['required', 'date'],
            'event_end_date' => ['required', 'date'],
            'reg_start_date' => ['required', 'date'],
            'reg_end_date' => ['required', 'date'],
            'organization' => ['required', 'max:255'],
            'event_type' => ['required', 'max:255'],
            'subscription_fee_type' => ['required', 'max:255'],
            'max_participant' => ['required', 'max:255'],
            'subscription_fee' => ['required', 'max:255'],
            //   'publish_type' => ['required', 'max:255'],
            'map_url' => ['sometimes','URL'],
            'social_url' => ['sometimes','URL'],
            'faq_url' => ['sometimes','URL'],
            'description' => ['sometimes'],
            'contact' => ['required', 'max:255'],
        ];
    }
}
