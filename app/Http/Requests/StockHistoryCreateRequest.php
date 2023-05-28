<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockHistoryCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'store_id' => ['required'],
            'stock_id' => ['required'],
            'change' => ['required', 'numeric'],
        ];
    }
}
