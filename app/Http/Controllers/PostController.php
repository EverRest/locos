<?php

namespace App\Http\Controllers;

use App\Abstracts\AController;
use App\Exceptions\InternalServerError;
use App\Http\Requests\ListOrderableSearchableRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

/**
 * Class PostController
 *
 * @package App\Http\Controllers
 */
class PostController extends AController
{

    /**
     * AccidentController constructor.
     *
     * @param  PostService  $service
     */
    public function __construct(PostService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param  ListOrderableSearchableRequest  $request
     *
     * @return Response
     * @throws InternalServerError
     */
    public function index(ListOrderableSearchableRequest $request): Response
    {
        return response([
            'data' => $this->service->list($request->validated()),
            'pages' => $this->service->getPagesCount(),
            'page' => (int) $request->page ?? 1,
            'message' => self::MESSAGES['index']
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostStoreRequest  $request
     *
     * @return Response::paginate()
     * @throws InternalServerError
     */
    public function store(PostStoreRequest $request): Response
    {
        return response([
            'data' => $this->service->save($request->validated()),
            'message' => self::MESSAGES['store']
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     *
     * @return Response
     * @throws InternalServerError|AuthorizationException
     */
    public function show(Post $post): Response
    {
        $data = [];
        $code = Response::HTTP_FORBIDDEN;
        $message = self::MESSAGES['error'];
        if ($this->authorize('view', [$post])) {
            $data = $this->service->item($post);
            $code = Response::HTTP_OK;
            $message = self::MESSAGES['show'];
        }
        return response([
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest  $request
     * @param  Post  $post
     *
     * @return Response
     * @throws InternalServerError
     * @throws AuthorizationException
     */
    public function update(PostUpdateRequest $request, Post $post): Response
    {
        $data = [];
        $code = Response::HTTP_FORBIDDEN;
        $message = self::MESSAGES['error'];
        if ($this->authorize('update', $post)) {
            $data = $this->service->update($request->validated(), $post);
            $code = Response::HTTP_OK;
            $message = self::MESSAGES['update'];
        }
        return response([
            'data' => $data,
            'message' => $message
        ], $code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     *
     * @return Response
     * @throws AuthorizationException
     * @throws InternalServerError
     */
    public function destroy(Post $post): Response
    {
        $code = Response::HTTP_FORBIDDEN;
        $message = self::MESSAGES['error'];
        if ($this->authorize('delete', $post)) {
            $this->service->delete($post);
            $code = Response::HTTP_ACCEPTED;
            $message = self::MESSAGES['destroy'];
        }

        return response(['message' => $message], $code);
    }
}
