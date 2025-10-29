<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow only authenticated users
        // return auth()->check();
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product'); // get product id from route

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($productId),
            ],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock_quantity' => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a text value.',
            'name.max' => 'The product name may not be greater than 255 characters.',
            'name.unique' => 'This product name already exists.',

            'description.string' => 'The description must be text.',

            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price cannot be negative.',

            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category is invalid.',

            'stock_quantity.integer' => 'The stock quantity must be an integer.',
            'stock_quantity.min' => 'The stock quantity must be at least 0.',

            'is_active.boolean' => 'The active status must be true or false.',

            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be jpeg, png, or jpg format.',
            'image.max' => 'The image may not be greater than 2MB.',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('price')) {
            $this->merge([
                'price' => str_replace(',', '.', $this->price),
            ]);
        }

        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
