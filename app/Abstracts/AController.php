<?php

namespace App\Abstracts;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class AController
 *
 * @package App\Abstracts
 */
class AController extends Controller
{
    /**
     * @var
     */
    protected $service;

    /**
     * @var
     */
    protected $user;

    /**
     * @const string[]
     */
    protected const MESSAGES = [
        'index' => 'Listed successfully',
        'store' => 'Created successfully',
        'show' => 'Retrieved successfully',
        'update' => 'Updated successfully',
        'destroy' => 'Deleted successfully',
        'error' => 'Http server error.'
    ];

    /**
     * AController constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

}