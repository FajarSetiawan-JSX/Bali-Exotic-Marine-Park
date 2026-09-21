<?php

namespace App\Http\Resources\Admin\Schedule;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetFullDayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = Carbon::parse($this->date);
        return [
            'id' => $this->id,
            'original' => $this->date,
            'date' => $date->day,
            'day' => $date->format('l')
        ];
    }
}
