<?php

namespace App\Http\Requests\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
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
            'title' => ['required','string'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'título',
            'balance' => 'monto',
        ];
    }

    public function messages()
    {
        return [
            'amount.numeric' => 'el campo monto debe ser un número y con el formato 0.00',
        ];
    }
}
