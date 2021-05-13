<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pet;
use App\Models\UserPet;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PetPolicy
 *
 * @package App\Policies
 */
class PetPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @return mixed
     */
    public function view(User $user, Pet $pet)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  User  $user
     * @param  Pet  $pet
     *
     * @return mixed
     */
    public function update(User $user, Pet $pet)
    {
        return !!UserPet::where([
            ['user_id', '=', $user->id],
            ['pet_id', '=', $pet->id]
        ])->get();
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  User  $user
     * @param  Pet  $pet
     *
     * @return mixed
     */
    public function delete(User $user, Pet $pet)
    {
        return !!UserPet::where([
            ['user_id', '=', $user->id],
            ['pet_id', '=', $pet->id]
        ])->get();
    }
}
