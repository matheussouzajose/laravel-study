<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'filled|max:255',
            'price' => 'filled|numeric|gte:0',
            'description' => 'filled|string',
            'stock' => 'filled|integer|gte:0',
            'category_id' => 'filled|numeric|exists:categories,id'
        ];
    }
}
