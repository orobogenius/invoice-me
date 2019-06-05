<?php

namespace App\Http\Requests;

use App\Invoice;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StroreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'exists:customers,id|required',
            'description' => 'string',
            'due_date' => 'date',
            'line_items' => 'array',
            'line_items.*.description' => 'string|nullable',
            'line_items.*.quantity' => 'sometimes|required|integer',
            'line_items.*.unit_price' => 'sometimes|required|numeric',
            'line_items.*.amount' => 'sometimes|required|numeric',
            'channels' => [
                'array',
                Rule::in(Invoice::$channels)
            ]
        ];
    }
}
