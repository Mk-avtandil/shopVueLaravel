<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:1', 'max:10000000'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
