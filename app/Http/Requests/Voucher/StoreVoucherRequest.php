<?php

namespace App\Http\Requests\Voucher;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoucherRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fio' => 'required',
            'room' => 'required',
            'phone' => 'required',
            'date_begin' => 'required',
            'date_end' => 'required',
        ];
    }

    public function getPhone(): int
    {
        return (int) str_replace(['+', ' '], '', $this->get('phone'));
    }

    /**
     * @return mixed
     */
    public function getDateBegin()
    {
        return $this->get('date_begin');
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->get('date_end');
    }

    public function getDay()
    {
        $begin = strtotime($this->getDateBegin());
        $end = strtotime($this->getDateEnd());

        $days = $begin - $end;

        return abs($days / 86400);
    }
}
