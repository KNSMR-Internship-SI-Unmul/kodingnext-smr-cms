<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'description'           => $this->description,
            'age_range'             => $this->age_range,
            'duration_per_session'  => $this->duration_per_session,
            'category'              => $this->category, 
            'image_url'             => $this->image ? asset('storage/' . $this->image) : null,
            'course_type'           => $this->courseType ? $this->courseType->name : null,
        ];
    }
}
