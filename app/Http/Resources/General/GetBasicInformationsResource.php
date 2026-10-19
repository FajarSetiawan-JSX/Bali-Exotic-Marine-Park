<?php

namespace App\Http\Resources\General;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetBasicInformationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $supervisor = User::whereHas('division.division', function ($q) {
            $q->where('id', '=', $this->division->id);
        })->first();
        return [
            'id' => $this->id,
            'user' => $this->templete->user->name,
            'time' => $this->templete->templetetime->time,
            'division' => $this->division->name,
            'date' => $this->date,
            'handover' => $this->handover,
            'detail' => $this->additional->detail ?? null,
            'supervisor' => $supervisor->name ?? 'Unknown',
            'tanggal' => $this->created_at
        ];
    }
}
