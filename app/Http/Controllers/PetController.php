<?php

namespace App\Http\Controllers;

use App\Abstracts\AController;
use App\Exceptions\InternalServerError;
use App\Http\Requests\ListOrderableSearchableRequest;
use App\Http\Requests\PetStoreRequest;
use App\Http\Requests\PetUpdateRequest;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\Response;

/**
 * Class PetController
 *
 * @package App\Http\Controllers
 */
class PetController extends AController
{
    /**
     * AccidentController constructor.
     *
     * @param  PetService  $service
     */
    public function __construct(PetService $service)
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
        ],
            Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PetStoreRequest  $request
     *
     * @return Response
     * @throws InternalServerError
     */
    public function store(PetStoreRequest $request): Response
    {
        return response([
            'data' => $this->service->save($request->validated()),
            'message' => self::MESSAGES['store']
        ],
            Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  Pet  $pet
     *
     * @return Response
     * @throws InternalServerError
     */
    public function show(Pet $pet): Response
    {
        return response([
            'data' => $this->service->item($pet),
            'message' => self::MESSAGES['show']
        ],
            Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PetUpdateRequest  $request
     * @param  Pet  $pet
     *
     * @return Response
     * @throws InternalServerError
     */
    public function update(PetUpdateRequest $request, Pet $pet): Response
    {
        return response([
            'data' => $this->service->update($request->validated(), $pet),
            'message' => self::MESSAGES['update']
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pet  $pet
     *
     * @return Response
     */
    public function destroy(Pet $pet): Response
    {
        $pet->delete();
        return response([
            'message' => self::MESSAGES['destroy']
        ], Response::HTTP_ACCEPTED);
    }
}
