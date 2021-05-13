<?php

namespace App\Http\Requests;

use App\Rules\RealPageRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ListOrderableSearchableRequest extends FormRequest
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
            'orderBy' => ['required', 'string', 'max:255'],
            'order' => ['required', 'string', 'in:asc,desc'],
            'page' => ['required', 'integer', new RealPageRule()],
            'search' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
