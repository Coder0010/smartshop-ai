<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use MkamelMasoud\StarterCoreKit\Rules\NoHtmlRule;

class AdminProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->ignore($this->route('product')),
                new NoHtmlRule,
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'description' => [
                'required',
                'string',
                'max:1000',
                new NoHtmlRule,
            ],
            'image' => [
                'nullable',
                'image',
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $id = $this->route('id') ?? $this->route('product');

        $modalName = $id
            ? 'edit-popup-model-' . $id
            : 'create-popup-model';

        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_popup_modal', $modalName)
        );

    }
}
