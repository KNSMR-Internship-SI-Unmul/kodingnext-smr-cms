<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'role'            => $this->role ? $this->role->name : null,
            'image_url'       => $this->profile_picture ? asset('storage/' . $this->profile_picture) : null,
        ];
    }
}
