<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'min:5', 'max:255'],
        ];
    }
}
