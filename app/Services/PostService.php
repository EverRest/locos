<?php


namespace App\Services;


use App\Abstracts\AService;
use App\Contracts\IPostRepository;
use App\Exceptions\InternalServerError;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PostService
 *
 * @package App\Services
 */
class PostService extends AService
{

    /**
     * @var string
     */
    protected $redis_key  = 'post';

    /**
     * AccidentService constructor.
     *
     * @param  IPostRepository  $postRepository
     */
    public function __construct(IPostRepository  $postRepository)
    {
        $this->repository = $postRepository;
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
            return PostResource::collection($this->getEntitiesCollection($data));
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
            $post = Post::create($data);
            return new PostResource($post);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *1
     *
     * @param  Post $post
     *
     * @return PostResource
     * @throws InternalServerError
     */
    public function item(Post $post): JsonResource
    {
        try {
            return new PostResource($post);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  Post  $post
     *
     * @return JsonResource
     * @throws InternalServerError
     */
    public function update(array $data, Post $post): JsonResource
    {
        try {
            $post->update($data);

            return new PostResource($post);
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     *
     * @return bool
     * @throws InternalServerError
     */
    public function delete(Post $post): bool
    {
        try {
            return $post->delete();
        } catch (Exception $e) {
            throw new InternalServerError($e->getMessage());
        }
    }
}