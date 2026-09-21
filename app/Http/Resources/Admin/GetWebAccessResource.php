<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetWebAccessResource extends JsonResource
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
            'id_web' => $this->web->id,
            'name' => $this->web->name,
            'route' => $this->web->route,
            'scope' => $this->web->scope,
            'methode' => $this->web->methode->methode,
            'type' => 'WEB / PAGE',
            'description' => $this->web->description ?? 'No description'
        ];
    }
}
