<?php

namespace App\Console\Commands;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddUsersPetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:users:pets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $pets = Pet::all();
        $usersCount = User::all()->count();
        $pets->each(function ($pet, $key) use ($usersCount) {
            $user = User::findOrFail(rand(1, $usersCount));
            DB::table('users_pets')->insert([
                'pet_id' => $pet->id,
                'user_id' => $user->id
            ]);
        });
    }
}
