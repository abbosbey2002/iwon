<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'nullable',
            'voucher' => 'required',
        ];
    }

    public function getPhone(): int
    {
        return  '+998'.str_replace(' ', '', $this->phone);
    }

    public function getVoucherID(): int
    {
        return (int) $this->get('voucher');
    }
}
