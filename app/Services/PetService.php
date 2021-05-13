<?php

namespace App\Services;

use App\Abstracts\AService;
use App\Contracts\IPetRepository;
use App\Exceptions\InternalServerError;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PetService
 *
 * @package App\Services
 */
class PetService extends AService
{

    /**
     * @var string
     */
    protected $redis_key  = 'pet';

    /**
     * AccidentService constructor.
     *
     * @param  IPetRepository  $petRepository
     */
    public function __construct(IPetRepository $petRepository)
    {
        $this->repository = $petRepository;
    }

    /**
     * @param  array  $data
     *
     * @return AnonymousResourceCollection
     * @throws InternalServerError
     */
    public function list(array $data): AnonymousResourceCollection
    {
        try {
            return PetResource::collection($this->getEntitiesCollection($data));
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     *
     * @return PetResource::paginate()
     * @throws InternalServerError
     */
    public function save(array $data): JsonResource
    {
        try {
            $pet = Pet::create($data);
            $pet->owners()->sync($data['owner_id'], false);
            return new PetResource($pet);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *1
     *
     * @param  Pet  $pet
     *
     * @return PetResource
     * @throws InternalServerError
     */
    public function item(Pet $pet): JsonResource
    {
        try {
            return new PetResource($pet);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  Pet  $pet
     *
     * @return PetResource
     * @throws InternalServerError
     */
    public function update(array $data, Pet $pet): JsonResource
    {
        try {
            $pet->update($data);
            if ($data['owner_id']) {
                $pet->owners()->sync($data['user_id'], false);
            }

            return new PetResource($pet);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pet  $pet
     *
     * @return bool
     * @throws InternalServerError
     */
    public function delete(Pet $pet): bool
    {
        try {
            return $pet->delete();
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }
}
