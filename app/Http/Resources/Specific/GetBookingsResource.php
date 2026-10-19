<?php

namespace App\Http\Resources\Specific;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetBookingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $division = Division::where('name', '=', $this->basic->templete->user->getdivision())->with(['assign.user'])->first();
        $total = $this->order()->get()->sum(function ($item) {
            return $item->program->price;
        });
        $order = $this->order()->get()->map(function ($item) {
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
            'spv' => $division->assign->user->name ?? 'Unknow',
            'name' => $this->name,
            'mail' => $this->email ? true : false,
            'contact' => $this->email ?? decrypt($this->whatsapp),
            'methode' => $this->methode_booking->name,
            'guide' => $this->guide ?? 'No Guide',
            'activity' => $this->activity,
            'payment' => $this->payment,
            'order' => $order,
            'total' => $total,
            'date' => $this->created_at
        ];
    }
}
