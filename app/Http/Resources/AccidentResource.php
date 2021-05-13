<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AccidentResource
 * @package App\Http\Resources
 */
class AccidentResource extends JsonResource
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
            'city' => $this->city,
            'accident' => $this->accident,
            'user' => new UserWithoutRelationsResource($this->user),
            'pet' => new PetWithoutRelationsResource($this->pet),
            'coordinates' => $this->coordinates,
            'happened_at' => $this->created_at
        ];
    }
}
