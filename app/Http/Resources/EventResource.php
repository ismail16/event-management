<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                      => $this->id,
            'name'                    => $this->name,
            'venue'                   => $this->venue,
            'email'                   => $this->email,
            'phone'                   => $this->phone,
            'event_start_date'        => $this->event_start_date,
            'event_end_date'          => $this->event_end_date,
            'reg_start_date'          => $this->reg_start_date,
            'reg_end_date'            => $this->reg_end_date,
            'organization'            => $this->organization,
            'contact'                 => $this->contact,
            'is_registration_allowed' => $this->is_registration_allowed,
            'is_published'            => $this->is_published,
            'map_url'                 => $this->map_url,
            'faq_url'                 => $this->faq_url,
            'social_url'              => $this->social_url,
            'images'                  => MediaResource::collection(
                $this->whenLoaded('media', $this->media, [])
            )
        ];
    }
}
