<?php


namespace App\Abstracts;

use App\Contracts\IRepository;
use App\Contracts\IService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class AService
 * @package App\Abstracts
 */
abstract class AService implements IService
{
    /**
     * @var IRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $redis_key  = 'default';

    /**
     *
     * @return int
     */
    public function getPagesCount(): int
    {
        return $this->repository->count();
    }

    /**
     * @param  array  $data
     *
     * @return Collection
     */
    protected function getEntitiesCollection(array $data): Collection
    {
        $limit = $this->repository->limit();
        return Cache::remember($this->redis_key . json_encode($data), 6000, function() use ($data, $limit) {
            return $this->repository->findBy(
                [],
                $data['orderBy'] && $data['order'] ? [$data['orderBy'] => $data['order']] : [],
                $limit,
                ($data['page'] - 1) * $limit,
                $data['search'] ?? null);
        });
    }
}
