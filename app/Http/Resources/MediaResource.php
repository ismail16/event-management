<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'file_name'         => $this->file_name,
            'mime_type'         => $this->mime_type,
            'size'              => $this->size,
            'responsive_images' => $this->responsive_image,
            'url'               => $this->getUrl(),
            'full_url'          => $this->getFullUrl()
        ];
    }
}
