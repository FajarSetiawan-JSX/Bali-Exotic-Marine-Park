<?php

namespace App\Http\Resources\General;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserContractsResource extends JsonResource
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
            'id_contract' => $this->contract->id,
            'id_user' => $this->user->id,
            'name' => $this->contract->name,
            'duration' => $this->contract->duration,
            'in' => $this->in,
            'expired' => Carbon::parse($this->in)->addMonths($this->contract->duration)->toDateString(),
            'user' => $this->user->name
        ];
    }
}
