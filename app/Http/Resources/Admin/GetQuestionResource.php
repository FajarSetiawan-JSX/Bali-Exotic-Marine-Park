<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'type' => $this->type,
            'part' => $this->part ?? null,
            'division' => $this->division->name,
            'division_id' => $this->division->id,
            'section' => $this->section->section->name ?? null,
            'section_id' => $this->section->section->id ?? null
        ];
    }
}
