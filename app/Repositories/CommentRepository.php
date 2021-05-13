<?php

namespace App\Repositories;

use App\Abstracts\ARepository;
use App\Contracts\ICommentRepository;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CommentRepository
 *
 * @package App\Repositories
 */
class CommentRepository extends ARepository implements ICommentRepository
{
    /**
     * @var string[]
     */
    protected $searchable = [
        'text'
    ];

    /**
     * @return Builder
     */
    protected function getQueryBuilder(): Builder
    {
        return Comment::query();
    }
}