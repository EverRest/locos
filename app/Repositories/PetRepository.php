<?php


namespace App\Repositories;


use App\Abstracts\ARepository;
use App\Contracts\IPetRepository;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PetRepository
 * @package App\Repositories
 */
class PetRepository extends ARepository implements IPetRepository
{
    /**
     * @const string[]
     */
    protected $searchable = [
        'pets.name',
        'pets.description',
//        'pet_types.type',
//        'users.name'
    ];

    /**
     * @return Builder
     */
    protected function getQueryBuilder(): Builder
    {
        return Pet::query();
    }
}
