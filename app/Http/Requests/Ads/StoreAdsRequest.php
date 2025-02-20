<?php

namespace App\Http\Requests\Ads;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdsRequest extends FormRequest
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
            'name' => 'required|string',
            'desktop' => 'required|mimes:webp, avif|dimensions:min_width=1920,max_width=1920,min_height=1080,max_height=1080',
            'mobile' => 'required|mimes:webp, avif|dimensions:min_width=640,max_width=720,min_height=800,max_height=1280',
            'video' => 'nullable|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:102400',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
        ];
    }
}
