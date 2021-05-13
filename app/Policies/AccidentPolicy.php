<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Accident;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class AccidentPolicy
 *
 * @package App\Policies
 */
class AccidentPolicy
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
     * @param  User  $user
     * @param  Accident  $accident
     * @return mixed
     */
    public function view(User $user, Accident $accident): bool
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  User  $user
     * @param  Accident  $accident
     * @return mixed
     */
    public function update(User $user, Accident  $accident): bool
    {
        return $user->id == $accident->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  User  $user
     * @param  Accident  $accident
     * @return mixed
     */
    public function delete(User $user, Accident  $accident): bool
    {
        return $user->id == $accident->user_id;
    }
}
