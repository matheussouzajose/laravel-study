<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreProductCover extends FormRequest
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
            'cover' => 'required|file|mimes:jpg,jpeg,bmp,png',
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
