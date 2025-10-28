<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow only authenticated users
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock_quantity' => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4048',
        ];
    }

    public function messages(): array
    {
        return [
            // Name
            'name.required' => 'The product name field is required.',
            'name.string' => 'The product name must be a valid text value.',
            'name.max' => 'The product name may not be greater than 255 characters.',

            // Description
            'description.string' => 'The description must be a valid text.',

            // Price
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a numeric value.',
            'price.min' => 'The price must be at least 0.',

            // Category
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',

            // Stock
            'stock_quantity.integer' => 'The stock quantity must be an integer.',
            'stock_quantity.min' => 'The stock quantity must be at least 0.',

            // Active status
            'is_active.boolean' => 'The active status must be true or false.',

            // Image
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'image.max' => 'The image may not be greater than 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'product name',
            'description' => 'product description',
            'price' => 'price',
            'category_id' => 'category',
            'stock_quantity' => 'stock quantity',
            'is_active' => 'active status',
            'image' => 'product image',
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
