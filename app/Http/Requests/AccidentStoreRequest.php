<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccidentStoreRequest
 * @package App\Http\Requests
 */
class AccidentStoreRequest extends FormRequest
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
            'pet_id' => ['required', 'integer', 'exists:pets,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'city' => ['required', 'string', 'max:255'],
            'accident' => ['required', 'string'],
            'coordinates' => ['required', 'json'],
        ];
    }
}
