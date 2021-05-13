<?php


namespace App\Repositories;


use App\Abstracts\ARepository;
use App\Contracts\IPostRepository;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PostRepository
 *
 * @package App\Repositories
 */
class PostRepository extends ARepository implements IPostRepository
{
    /**
     * @const string[]
     */
    protected $searchable = [
        'posts.title',
        'posts.text',
//        'pet_types.type',
//        'users.name'
    ];

    /**
     * @return Builder
     */
    protected function getQueryBuilder(): Builder
    {
        return Post::query();
    }
}