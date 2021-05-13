<?php

namespace Database\Seeders;

use App\Models\PetType;
use Illuminate\Database\Seeder;

/**
 * Class PetTypesSeeder
 * @package Database\Seeders
 */
class PetTypesSeeder extends Seeder
{
    /**
     * @const string[]
     */
    private const TYPES = [
        'dog',
        'cat',
        'bird',
        'snake',
        'fish',
        'spike'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        array_map(function (string $type){
            PetType::create([
                'type' => $type
            ]);
        }, self::TYPES);
    }
}
