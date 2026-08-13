<?php

namespace App\Http\Resources\Admin\Schedule;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetShiftingResource extends JsonResource
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
            'start' => $this->start,
            'end' => $this->end,
            'break_start' => $this->break_start,
            'break_end' => $this->break_end,
        ];
    }
}
