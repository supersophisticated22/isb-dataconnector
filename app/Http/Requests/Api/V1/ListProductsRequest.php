<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ListProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'manufacturer' => ['nullable', 'string', 'max:255'],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'gte:min_price'],
            'has_discount' => ['nullable', 'boolean'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'q.string' => __('saas.api.products.validation.q.string'),
            'q.max' => __('saas.api.products.validation.q.max'),
            'category.string' => __('saas.api.products.validation.category.string'),
            'category.max' => __('saas.api.products.validation.category.max'),
            'manufacturer.string' => __('saas.api.products.validation.manufacturer.string'),
            'manufacturer.max' => __('saas.api.products.validation.manufacturer.max'),
            'min_price.numeric' => __('saas.api.products.validation.min_price.numeric'),
            'min_price.min' => __('saas.api.products.validation.min_price.min'),
            'max_price.numeric' => __('saas.api.products.validation.max_price.numeric'),
            'max_price.gte' => __('saas.api.products.validation.max_price.gte'),
            'has_discount.boolean' => __('saas.api.products.validation.has_discount.boolean'),
            'page.integer' => __('saas.api.products.validation.page.integer'),
            'page.min' => __('saas.api.products.validation.page.min'),
            'per_page.integer' => __('saas.api.products.validation.per_page.integer'),
            'per_page.min' => __('saas.api.products.validation.per_page.min'),
            'per_page.max' => __('saas.api.products.validation.per_page.max'),
        ];
    }
}
