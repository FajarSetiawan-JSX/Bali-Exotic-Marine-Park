<?php

namespace App\Http\Resources\Specific;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMamalReportResource extends JsonResource
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
            'date' => $this->basic->date->date,
            'officer' => $this->basic->templete->user->name,
            'mamal' => $this->mamal->name,
            'diet' => $this->diet,
            'breathe' => $this->breathe,
            'faces' => $this->faces,
            'floating' => $this->floating,
            'attentive' => $this->attentive,
            'skin' => $this->skin,
            'eyes' => $this->eyes,
            'remark' => $this->remark,
            'vet' => $this->mamalreportvet ? [
                'id' => $this->mamalreportvet->id,
                'officer' => $this->mamalreportvet->basic->templete->user->name,
                'program' => $this->mamalreportvet->program->name,
                'group' => $this->mamalreportvet->group,
                'health' => $this->mamalreportvet->health,
                'klinis' => $this->mamalreportvet->klinis,
                'social' => $this->mamalreportvet->social,
                'status' => $this->mamalreportvet->status,
                'additional' => $this->mamalreportvet->additional,
                'remark' => $this->mamalreportvet->remark
            ] : null
        ];
    }
}
