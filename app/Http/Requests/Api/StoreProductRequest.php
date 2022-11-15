<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
        $companyId = Auth::user()->company_id;

        return [
            'name' => 'required|max:255',
            'price' => 'required|numeric|gte:0',
            'description' => 'string|nullable',
            'stock' => 'required|integer|gte:0',
            'category_id' => [
                'numeric',
                'required',
                Rule::exists('categories', 'id')
                    ->withoutTrashed()
                    ->where('company_id', $companyId)
            ]
        ];
    }
}
