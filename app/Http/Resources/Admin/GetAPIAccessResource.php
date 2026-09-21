<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAPIAccessResource extends JsonResource
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
            'id_api' => $this->api->id,
            'name' => $this->api->name,
            'route' => $this->api->route,
            'url' => $this->api->url,
            'scope' => $this->api->scope,
            'methode' => $this->api->methode->methode,
            'type' => 'API',
            'description' => $this->api->description ?? 'No description'
        ];
    }
}
