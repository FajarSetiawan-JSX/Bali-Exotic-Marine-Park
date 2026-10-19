<?php

namespace App\Http\Resources\Specific;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $total = 0;
        $order = $this->order()->get()->map(function ($item) use ($total) {
            $total += $item->program->price;
            return [
                'id' => $item->id,
                'program' => $item->program->program->name . '-' . $item->program->category,
                'price' => $item->program->price,
                'session' => $item->session
            ];
        });
        return [
            'id' => $this->id,
            'basic_id' => $this->basic->id,
            'author' => $this->basic->templete->user->name,
            'name' => $this->name,
            'contact' => $this->email ?? decrypt($this->whatsapp),
            'methode' => $this->methode_booking->name,
            'guide' => $this->guide ?? 'No Guide',
            'activity' => $this->activity,
            'payment' => $this->payment,
            'order' => $order,
            'total' => $this->total,
            'date' => $this->created_at
        ];
    }
}
