<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'image_url'     => $this->image ? asset('storage/' . $this->image) : null,
            'start_date'    => $this->start_date->format('Y-m-d'),
            'end_date'      => $this->end_date->format('Y-m-d'),
            'format'        => $this->file_format, 
            'created_by'    => $this->user ? $this->user->name : 'System',
        ];
    }
}
