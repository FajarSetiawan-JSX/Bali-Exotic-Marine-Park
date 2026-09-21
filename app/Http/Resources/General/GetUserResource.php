<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserResource extends JsonResource
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
            'name' => $this->name,
            'nik' => decrypt($this->nik),
            'username' => $this->username,
            'email' => $this->email,
            'phone' => decrypt($this->phone),
            'emergency' => decrypt($this->emergency),
            'gender' => $this->gender,
            'city' => $this->born_at,
            'birthday' => $this->birthday,
            'address' => $this->address,
            'position' => $this->getposition(),
            'division' => $this->getdivision(),
            'level' => $this->getlevel(),
            'join' => $this->created_at,
            'status' => $this->status,
        ];
    }
}
