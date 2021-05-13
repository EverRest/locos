<?php


namespace App\Abstracts;


use App\Contracts\IRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class ARepository
 * @package App\Abstracts
 */
abstract class ARepository implements IRepository
{
    /**
     * @const integer
     */
    protected const PAGINATE = 20;

    /**
     * @var string[]
     */
    protected $searchable = [
    ];

    /**
     * @return Builder
     */
    protected abstract function getQueryBuilder(): Builder;

    /**
     * @param int $id
     * @return Model|null
     */
    public function findOne(int $id): Model
    {
        return $this->getQueryBuilder()->find($id);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return Model|null
     */
    public function findOneBy(array $criteria, array $orderBy = null): Model
    {
        $query = $this->getQueryBuilder()
            ->whereRowValues(array_keys($criteria), '=', array_values($criteria));
        if (!empty($orderBy)) {
            foreach ($orderBy as $column => $direction) {
                $query->orderBy($column, $direction);
            }
        }
        return $query->first();
    }

    /**
     * @return Model[]|Collection
     */
    public function findAll(): Collection
    {
        return $this->getQueryBuilder()
            ->get();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @param string|null $search
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|Model[]|Collection
     */
    public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null, string $search = null): Collection
    {
        $query = empty($criteria) ? $this->getQueryBuilder() : $this->getQueryBuilder()
            ->whereRowValues(array_keys($criteria), '=', array_values($criteria));

        if ($search) {
            $query->where(function ($query) use ($search) {
                for ($i = 0; $i < count($this->searchable); $i++) {
                    $query->orwhere($this->searchable[$i], 'like', '%' . $search . '%');
                }
            });
        }
        if (!empty($orderBy)) {
            foreach ($orderBy as $column => $direction) {
                $query->orderBy($column, $direction);
            }
        }
        if (isset($limit)) {
            $query->limit($limit);
        }
        if (isset($offset)) {
            $query->offset($offset);
        }
        return $query->get();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        $count = $this->getQueryBuilder()->count();
        $fullPages = intdiv($count,self::PAGINATE);
        return  ($count % self::PAGINATE) == 0 ?$fullPages : ++$fullPages;
    }

    /**
     * @return int
     */
    public function limit(): int
    {
        return self::PAGINATE;
    }
}
