<?php

namespace App\Http\Resources\Specific;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetVisitorResource extends JsonResource
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
            'count' => $this->count,
            'information' => $this->information,
            'time' => $this->time,
            'img' => $this->img,
            'category' => $this->category,
            'date' => $this->basicinformation->date->date,
            'user' => $this->basicinformation->templete->user->name,
        ];
    }
}
