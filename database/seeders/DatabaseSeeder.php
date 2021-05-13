<?php

namespace Database\Seeders;

use App\Models\Accident;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

/**
 * Class DatabaseSeeder
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        $this->call([
            PetTypesSeeder::class
        ]);
        Artisan::call('generate:users:pets');
        Pet::factory(200)->create();
        Accident::factory(50)->create();
    }
}
