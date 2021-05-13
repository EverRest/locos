<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CommentPolicy
 *
 * @package App\Policies
 */
class CommentPolicy
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
     * @param  Comment  $comment
     * @return mixed
     */
    public function view(User $user, Comment $comment): bool
    {
        return true;
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
     * @param  Comment $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id == $comment->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  User  $user
     * @param  Comment  $post
     * @return mixed
     */
    public function delete(User $user, Comment $post): bool
    {
        return $user->id == $post->user_id;
    }
}
