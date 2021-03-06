<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PostPolicy
 *
 * @package App\Policies
 */
class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @return mixed
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  User  $user
     * @param  Post  $post
     *
     * @return mixed
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  User  $user
     * @param  Post  $post
     *
     * @return mixed
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;
    }
}
