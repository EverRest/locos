<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class CommentUpdateRequest
 *
 * @package App\Http\Requests
 */
class CommentUpdateRequest extends FormRequest
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
            'parent_id' => ['sometimes', 'nullable', 'integer', 'exists:comments,id'],
            'user_id' => ['sometimes', 'integer', 'exists:users'],
            'post_id' => ['sometimes', 'integer', 'exists:posts'],
            'text' => ['sometimes', 'string']
        ];
    }
}
