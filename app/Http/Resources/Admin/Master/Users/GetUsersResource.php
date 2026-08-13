<?php

namespace App\Http\Resources\Admin\Master\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class GetUsersResource extends JsonResource
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
            'pict' => $this->profile,
            'name' => $this->name === Auth::user()->name ? 'You' : $this->name,
            'nik' => decrypt($this->nik),
            'username' => $this->username,
            'email' => $this->email,
            'phone' => decrypt($this->phone),
            'emergency' => decrypt($this->emergency),
            'gender' => $this->gender,
            'city' => $this->born_at,
            'birthday' => $this->birthday,
            'address' => $this->address,
            'division_id' => $this->division_id,
            'position' => $this->position()->get()->map(function ($position) {
                return [
                    'id' => $position->position->id,
                    'name' => $position->position->name
                ];
            }),
            'division' => $this->division->name,
            'level' => $this->division->level->level,
            'join' => $this->created_at,
            'status' => $this->status,
            'online' => $this->last_activity >= now()->subMinute(5) ? true : false
        ];
    }
}
