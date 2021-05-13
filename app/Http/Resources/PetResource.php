<?php

namespace App\Http\Resources;

use App\Models\Accident;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

/**
 * Class PetResource
 * @package App\Http\Resources
 */
class PetResource extends JsonResource
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
            'name' => $this->name,
            'years' => $this->years,
            'type' => $this->type,
            'owners' => $this->owners->map(function (?User $user) {
                return new UserWithoutRelationsResource($user);
            }),
            'accidents' => $this->accidents?$this->accidents->map(function (?Accident $accidentItem) {
                return new AccidentWithoutRelationsResource($accidentItem);
            }):[],
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
