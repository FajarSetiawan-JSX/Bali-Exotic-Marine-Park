<?php

namespace App\Http\Resources\Admin\Master\Division;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetDivisionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $total = $this->getuser()->count();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'level' => $this->level->level,
            'unit' => $this->unit->unit->name,
            'description' => $this->description,
            'user' => $total > 5 ? $this->getuser()->take(4) : $this->getuser(),
            'total' => $total
        ];
    }
}
