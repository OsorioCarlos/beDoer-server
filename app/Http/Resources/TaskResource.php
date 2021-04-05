<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'expiration_date' => $this->expiration_date,
            'state_id' => $this->state_id,
            'created_by' => $this->created_by,
            'teamspace' => $this->teamspace,
            'deleted' => $this->deleted,
        ];
    }
}
