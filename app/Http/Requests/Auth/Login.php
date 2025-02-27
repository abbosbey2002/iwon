<?php

namespace App\Http\Requests\Site\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'phone' => 'required',
            'voucher_id' => 'required',
        ];
    }

    public function getPhone(): int
    {
        return  '+998'.str_replace(' ', '', $this->phone);
    }

    public function getVoucherID(): int
    {
        return (int) $this->get('voucher_id');
    }
}
