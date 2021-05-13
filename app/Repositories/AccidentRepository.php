<?php


namespace App\Repositories;


use App\Abstracts\ARepository;
use App\Contracts\IAccidentRepository;
use App\Models\Accident;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AccidentRepository
 * @package App\Repositories
 */
class AccidentRepository extends ARepository implements IAccidentRepository
{
    /**
     * @const string[]
     */
    protected $searchable = [
//        'pets.name',
//        'pets.description',
//        'pet_types.type',
//        'users.name',
        'accidents.city',
        'accidents.accident',
    ];

    /**
     * @return Builder
     */
    protected function getQueryBuilder(): Builder
    {
        return Accident::query();
    }
}
