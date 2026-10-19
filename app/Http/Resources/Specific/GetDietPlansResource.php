<?php

namespace App\Http\Resources\Specific;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetDietPlansResource extends JsonResource
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
            'officer' => $this->basic->templete->user->name,
            'mamal_id' => $this->mamal->id,
            'mamal' => $this->mamal->name,
            'date' => $this->basic->date->date,
            'total' => $this->total,
            'gelatin' => $this->gelatin,
            'selar' => $this->selar,
            'layang' => $this->layang,
            'approval' => $this->approve ? [
                'officer' => $this->approve->basic->templete->user->name,
                'date' => $this->approve->basic->date->date,
                'execute' => $this->approve->execute ? [
                    'officer' => $this->approve->execute->basic->templete->user->name,
                    'date' => $this->approve->execute->basic->date->date,
                    'gelatin' => $this->approve->execute->gelatin,
                    'selar' => $this->approve->execute->selar,
                    'layang' => $this->approve->execute->layang,
                    'total' => $this->approve->execute->total,
                ] : null
            ] : null,
            'allow' => $this->approve ? true : false
        ];
    }
}
