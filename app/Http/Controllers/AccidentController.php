<?php

namespace App\Http\Controllers;

use App\Abstracts\AController;
use App\Exceptions\InternalServerError;
use App\Http\Requests\AccidentStoreRequest;
use App\Http\Requests\AccidentUpdateRequest;
use App\Http\Requests\ListOrderableSearchableRequest;
use App\Models\Accident;
use App\Services\AccidentService;
use Illuminate\Http\Response;

/**
 * Class AccidentController
 *
 * @package App\Http\Controllers
 */
class AccidentController extends AController
{

    /**
     * AccidentController constructor.
     *
     * @param  AccidentService  $service
     */
    public function __construct(AccidentService $service)
    {
        parent::__construct();
        $this->authorizeResource(Accident::class, 'accident');
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
     * @param  AccidentStoreRequest  $request
     *
     * @return Response::paginate()
     * @throws InternalServerError
     */
    public function store(AccidentStoreRequest $request): Response
    {
        return response([
            'data' => $this->service->save($request->validated()),
            'message' => self::MESSAGES['store']
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Accident  $accident
     *
     * @return Response
     * @throws InternalServerError
     */
    public function show(Accident $accident): Response
    {
        return response([
            'data' => $this->service->item($accident),
            'message' => self::MESSAGES['show']
        ],
            Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AccidentUpdateRequest  $request
     * @param  Accident  $accident
     *
     * @return Response
     * @throws InternalServerError
     */
    public function update(AccidentUpdateRequest $request, Accident $accident): Response
    {
        return response([
            'data' => $this->service->update($request->validated(), $accident),
            'message' => self::MESSAGES['update']
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Accident  $accident
     *
     * @return Response
     * @throws InternalServerError
     */
    public function destroy(Accident $accident): Response
    {
        $this->service->delete($accident);

        return response(['message' => self::MESSAGES['destroy']], Response::HTTP_ACCEPTED);
    }
}
