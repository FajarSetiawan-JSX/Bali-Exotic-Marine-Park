<?php

namespace App\Http\Resources\Admin\Master\Division;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetPositionResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'position' => $this->position,
            'division' => $this->division->name
        ];
    }
}
