<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a valid text.',
            'name.max' => 'The category name cannot exceed 255 characters.',
            'name.unique' => 'This category name already exists.',

            'description.string' => 'The description must be a valid text.',

            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be jpeg, png, or jpg format.',
            'image.max' => 'The image size may not exceed 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'category name',
            'description' => 'category description',
            'image' => 'category image',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
    }
}
