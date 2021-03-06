<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;

class AccountCreateRequest extends FormRequest
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
            'name' => ['required','string'],
            'balance' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'exists:currencies,id'],
            'icon' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'balance' => 'saldo',
            'currency' => 'tipo de moneda',
            'icon' => 'ícono',
            'description' => 'descripción',
        ];
    }

    public function messages()
    {
        return [
            'balance.numeric' => 'el campo saldo debe ser un número y con el formato 0.00',
        ];
    }
}
