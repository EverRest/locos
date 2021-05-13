<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class PetUpdateRequest
 * @package App\Http\Requests
 */
class PetUpdateRequest extends FormRequest
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
            'type_id' => ['sometimes', 'integer', 'exists:pets'],
            'name' => ['sometimes', 'string', 'max:255'],
            'years' => ['sometimes', 'integer'],
            'description' => ['sometimes', 'string'],
        ];
    }
}
