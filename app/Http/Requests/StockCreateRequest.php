<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockCreateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'store_id' => ['required'],
            'unit' => ['required'],
            'stock_amount' => ['sometimes', 'numeric'],
        ];
    }
}
