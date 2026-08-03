<?php

namespace App\Http\Resources\Admin\Master\Attachment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAttachmentResource extends JsonResource
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
            'division' => $this->division->name,
            'nama' => $this->first_name,
            'teams' => $this->watch->map(function ($team) {
                return [
                    'id' => $team->id,
                    'division' => $team->division->name,
                    'color' => $team->division->hexa,
                    'user' => $team->division->user()->count()
                ];
            })
        ];
    }
}
