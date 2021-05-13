<?php

namespace App\Http\Controllers;

use App\Abstracts\AController;
use App\Exceptions\InternalServerError;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Requests\ListOrderableSearchableRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers
 */
class CommentController extends AController
{

    /**
     * AccidentController constructor.
     *
     * @param  CommentService  $service
     */
    public function __construct(CommentService $service)
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
     * @param  CommentStoreRequest  $request
     *
     * @return Response::paginate()
     * @throws InternalServerError
     * @throws AuthorizationException
     */
    public function store(CommentStoreRequest $request): Response
    {
        $data = [];
        $message = self::MESSAGES['error'];
        $code = Response::HTTP_FORBIDDEN;
        if ($this->authorize('create', [])) {
            $data = $this->service->save($request->validated());
            $message = self::MESSAGES['store'];
            $code = self::MESSAGES['store'];
        }
        return response([
            'data' => $data,
            'message' => $message
        ], $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  Comment  $comment
     *
     * @return Response
     * @throws InternalServerError
     * @throws AuthorizationException
     */
    public function show(Comment $comment): Response
    {
        $data = [];
        $message = self::MESSAGES['error'];
        $code = Response::HTTP_FORBIDDEN;
        if ($this->authorize('view', [$comment])) {
            $data = $this->service->item($comment);
            $message = self::MESSAGES['show'];
            $code = Response::HTTP_OK;
        }
        return response([
            'data' => $data,
            'message' => $message
        ],
            $code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CommentUpdateRequest  $request
     * @param  Comment  $comment
     *
     * @return Response
     * @throws InternalServerError
     * @throws AuthorizationException
     */
    public function update(CommentUpdateRequest $request, Comment $comment): Response
    {
        $data = [];
        $message = self::MESSAGES['error'];
        $code = Response::HTTP_FORBIDDEN;
        if ($this->authorize('update', [$comment])) {
            $data = $this->service->update($request->validated(), $comment);
            $message = self::MESSAGES['update'];
            $code = Response::HTTP_OK;
        }
        return response([
            'data' => $data,
            'message' => $message
        ], $code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment  $comment
     *
     * @return Response
     * @throws InternalServerError
     * @throws AuthorizationException
     */
    public function destroy(Comment $comment): Response
    {
        $message = self::MESSAGES['error'];
        $code = Response::HTTP_FORBIDDEN;

        if ($this->authorize('update', [$comment])) {
            $this->service->delete($comment);
            $message = self::MESSAGES['destroy'];
            $code = Response::HTTP_ACCEPTED;
        }

        return response(['message' => $message], $code);
    }
}
