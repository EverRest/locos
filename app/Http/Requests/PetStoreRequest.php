<?php

namespace App\Http\Requests;

use App\Rules\OwnersId;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class PetStoreRequest
 * @package App\Http\Requests
 */
class PetStoreRequest extends FormRequest
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
            'type_id' => ['required', 'integer', 'exists:pets'],
            'name' => ['required', 'string', 'max:255'],
            'years' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'owner_id' => ['required', 'array', new OwnersId()]
        ];
    }
}
