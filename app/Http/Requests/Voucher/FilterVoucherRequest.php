<?php

namespace App\Http\Requests\Dashboard\Voucher;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'date' => 'nullable|array|min:2',  // date massiv bo‘lishi va kamida 2 ta element bo‘lishi kerak
            'page' => 'required|integer|min:1',
            'limit' => 'required|integer|min:1',
            'month' => 'nullable|date_format:Y-m',  // Yil-oy formatida bo‘lishi kerak (2024-02)
        ];
    }

    public function getDate(): ?string
    {
        return optional($this->get('date'))[0] ?? null;
    }

    public function getDateEnd(): ?string
    {
        return optional($this->get('date'))[1] ?? null;
    }

    public function getPage(): int
    {
        return (int) $this->input('page', 1);  // Agar `page` bo‘lmasa, 1 qaytaradi
    }

    public function getMonth(): ?string
    {
        return $this->has('month') ? Carbon::parse($this->input('month'))->format('Y-m-d') : null;
    }

    public function getLimit(): int
    {
        return (int) $this->input('limit', 20);  // Agar `limit` bo‘lmasa, default 10 qaytaradi
    }
}
