<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AccidentWithoutRelationsResource
 * @package App\Http\Resources
 */
class AccidentWithoutRelationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'pet_id' => $this->pet_id,
            'user_id' => $this->user_id,
            'accident' => $this->accident,
            'coordinates' => $this->coordinates,
            'city' => $this->city,
            'happened_at' => $this->created_at,
        ];
    }
}
