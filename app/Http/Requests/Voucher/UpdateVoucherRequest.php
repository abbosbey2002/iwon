<?php

namespace App\Http\Requests\Dashboard\Voucher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fio' => 'required',
            'room' => 'required',
            'voucher_id' => 'required',
        ];
    }

    public function getFullName(): string
    {
        return (string) $this->get('fio');
    }

    public function getRoom(): string
    {
        return (string) $this->get('room');
    }

    public function getVoucherID(): int
    {
        return (int) $this->get('voucher_id');
    }
}
