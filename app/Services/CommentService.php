<?php


namespace App\Services;

use App\Abstracts\AService;
use App\Contracts\ICommentRepository;
use App\Exceptions\InternalServerError;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use League\Flysystem\Exception;

/**
 * Class CommentService
 *
 * @package App\Services
 */
class CommentService extends AService
{
    /**
     * @var string
     */
    protected $redis_key  = 'comment';

    /**
     * CommentService constructor.
     *
     * @param  ICommentRepository  $commentRepository
     */
    public function __construct(ICommentRepository $commentRepository)
    {
        $this->repository = $commentRepository;
    }

    /**
     * @param  array  $data
     *
     * @return AnonymousResourceCollection
     * @throws InternalServerError
     */
    public function list(array $data): AnonymousResourceCollection
    {
        try {
            return CommentResource::collection($this->getEntitiesCollection($data));
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     *
     * @return JsonResource
     * @throws InternalServerError
     */
    public function save(array $data): JsonResource
    {
        try {
            $accident = Comment::create($data);
            return new CommentResource($accident);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *1
     *
     * @param  Comment  $comment
     *
     * @return JsonResource
     * @throws InternalServerError
     */
    public function item(Comment $comment): JsonResource
    {
        try {
            return new CommentResource($comment);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  Comment  $comment
     *
     * @return JsonResource
     * @throws InternalServerError
     */
    public function update(array $data, Comment $comment): JsonResource
    {
        try {
            $comment->update($data);
            return new CommentResource($comment);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment $comment
     *
     * @return bool
     * @throws InternalServerError
     */
    public function delete(Comment $comment): bool
    {
        try {
            return $comment->delete();
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }
}