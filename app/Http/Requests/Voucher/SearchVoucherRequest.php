<?php

namespace App\Http\Requests\Dashboard\Search;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required',
            'date' => 'nullable',
            'page' => 'required',
            'limit' => 'required',
            'month' => 'nullable',
        ];
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->get('date')[0];
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->get('date')[1];
    }

    public function getPage(): int
    {
        return (int) $this->get('page');
    }

    /**
     * @return string
     */
    public function getMonth()
    {
        if ($this->get('month')) {
            return Carbon::parse($this->get('month'))->format('Y-m-d');
        }

        return false;
    }

    public function getLimit(): int
    {
        return (int) $this->get('limit');
    }

    public function getPhone(): string
    {
        return (string) $this->get('phone');
    }
}
