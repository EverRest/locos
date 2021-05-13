<?php

namespace App\Services;

use App\Abstracts\AService;
use App\Contracts\IAccidentRepository;
use App\Exceptions\InternalServerError;
use App\Http\Resources\AccidentResource;
use App\Models\Accident;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AccidentService
 *
 * @package App\Services
 */
class AccidentService extends AService
{

    /**
     * @var string
     */
    protected $redis_key  = 'accident';

    /**
     * AccidentService constructor.
     *
     * @param  IAccidentRepository  $accidentRepository
     */
    public function __construct(IAccidentRepository $accidentRepository)
    {
        $this->repository = $accidentRepository;
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
            return AccidentResource::collection($this->getEntitiesCollection($data));
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     *
     * @return JsonResource
     * @throws InternalServerError
     */
    public function save(array $data): JsonResource
    {
        try {
            $accident = Accident::create($data);
            return new AccidentResource($accident);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *1
     *
     * @param  Accident  $accident
     *
     * @return JsonResource
     * @throws InternalServerError
     */
    public function item(Accident $accident): JsonResource
    {
        try {
            return new AccidentResource($accident);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  Accident  $accident
     *
     * @return JsonResource
     * @throws InternalServerError
     */
    public function update(array $data, Accident $accident): JsonResource
    {
        try {
            $accident->update($data);
            return new AccidentResource($accident);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Accident  $accident
     *
     * @return bool
     * @throws InternalServerError
     */
    public function delete(Accident $accident): bool
    {
        try {
            return $accident->delete();
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }
}
