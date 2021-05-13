<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class InternalServerError
 * @package App\Exceptions
 */
class InternalServerError extends Exception
{
    /**
     * @const string
     */
    private const MESSAGE = 'Internal Server Error';

    /**
     * @param $request
     * @return JsonResponse|object
     */
    public function render($request)
    {
        return response()->json([
            'message' => self::MESSAGE,
            'error' => env('APP_DEBUG') ? $this->getMessage() : self::MESSAGE,
        ])->setStatusCode(501);
    }
}
