<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentProjectResource extends JsonResource
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
            'project_url'   => $this->project_url ?? null,
            'media_url'     => $this->media ? asset('storage/' . $this->media) : null,
            'module'        => $this->module ? $this->module->name : null,
            'student'       => $this->student ? $this->student->name : null,
        ];
    }
}
