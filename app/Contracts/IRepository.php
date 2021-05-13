<?php


namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface IRepository
 * @package App\Contracts
 */
interface IRepository
{
    /**
     * @param int $id
     * @return Model|null
     */
    public function findOne(int $id): Model;

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return Model|null
     */
    public function findOneBy(array $criteria, array $orderBy = null): Model;

    /**
     * @return Model[]|Collection
     */
    public function findAll();

    /**
     * @param  array  $criteria
     * @param  array|null  $orderBy
     * @param  int|null  $limit
     * @param  int|null  $offset
     * @param  string|null  $search
     *
     * @return Model[]|Collection
     */
    public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null, string $search = null);
}
