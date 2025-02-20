<?php

namespace App\Http\Requests\Traslations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTranslationRequest extends FormRequest
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
            'key' => [
                'required',
                'string',
                Rule::unique('translations')->where(fn ($query) => $query->where('language_code', $this->language_code))->ignore(optional($this->route('translation'))->id),
            ],
            'text' => 'required|string',
            'language_code' => 'required|exists:languages,code',
        ];
    }
}
