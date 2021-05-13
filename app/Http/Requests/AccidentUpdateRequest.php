<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccidentUpdateRequest
 * @package App\Http\Requests
 */
class AccidentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'pet_id' => ['sometimes', 'integer', 'exists:pets'],
            'user_id' => ['sometimes', 'integer', 'exists:users'],
            'city' => ['sometimes', 'string', 'max:255'],
            'accident' => ['sometimes', 'string'],
            'coordinates' => ['sometimes', 'json'],
        ];
    }
}
