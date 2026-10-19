<?php

namespace App\Http\Resources\Specific;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetDeliveryResource extends JsonResource
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
            'receiver' => $this->receiver,
            'sender' => $this->sender,
            'type' => $this->type,
            'status' => $this->status,
            'received_at' => $this->received_at,
            'information' => $this->information,
            'img' => $this->img,
            'officer' => [
                'name' => $this->basic->templete->user->name,
                'profile' => $this->basic->templete->user->profile,
                'date' => $this->basic->date->date
            ]
        ];
    }
}
