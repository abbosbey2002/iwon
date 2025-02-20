<?php

namespace App\Http\Requests\Traslations;

use Illuminate\Foundation\Http\FormRequest;

class StoreTranslationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string|unique:translations,key,NULL,id,language_code,'.$this->language_code,
            'text' => 'required|string',
            'language_code' => 'required|exists:languages,code',
        ];
    }
}
