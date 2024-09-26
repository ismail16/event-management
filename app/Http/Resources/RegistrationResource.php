<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'email'          => $this->email,
            'phone'          => $this->phone,
            'batch'          => $this->batch,
            'cadet_number'   => $this->cadet_number,
            'address'        => $this->address,
            'house'          => $this->house,
            'tshirt_size'    => $this->tshirt_size,
            'marital_status' => $this->marital_status,
            'event'          => EventResource::make($this->whenLoaded('event')),
            'payment'        => $this->whenLoaded('payment'),
            'guests'         => $this->whenLoaded('guests'),
        ];
    }
}
