<?php

namespace App\Http\Resources\Specific;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetWorkordersResource extends JsonResource
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
            'item' => $this->item,
            'status' => $this->status,
            'confirm' => $this->confirm,
            'remark' => $this->remark,
            'img' => $this->img,
            'officer' => [
                'name' => $this->basic->templete->user->name,
                'profile' => $this->basic->templete->user->profile,
                'division' => $this->basic->templete->user->getdivision(),
                'position' => $this->basic->templete->user->getposition(),
                'date' => $this->basic->date
            ],
            'supervisor' => $this->spv->name
        ];
    }
}
