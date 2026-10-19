<?php

namespace App\Http\Resources\Specific;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class GetNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();
        return [
            'id' => $this->id,
            'name' => $this->user->user->name,
            'position' => $this->user->divisionPosition->name,
            'notification' => $this->notification,
            'img' => $this->img,
            'date' => $this->created_at,
            'privillage' => $this->user->user->id == $user->id ? true : false
        ];
    }
}
