<?php

namespace App\Http\Requests\Api;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreProductStock extends FormRequest
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
            'stock' => "required|integer|gte:0|min:0",
            'product_id' => [
                'numeric',
                'required',
                Rule::exists('products', 'id')
                    ->withoutTrashed()
                    ->where('company_id', $companyId)
            ]
        ];
    }
}
