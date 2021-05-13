<?php

namespace App\Contracts;

use App\Exceptions\InternalServerError;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Interface IService
 *
 * @package App\Contracts
 */
interface IService
{
    /**
     * @param  array  $data
     *
     * @return AnonymousResourceCollection
     * @throws InternalServerError
     */
    public function list(array $data): AnonymousResourceCollection;

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     *
     * @return JsonResource
     * @throws InternalServerError
     */
    public function save(array $data): JsonResource;
}
