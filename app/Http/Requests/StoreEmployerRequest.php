<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:employers',
            'cpf' => 'required|unique:employers|regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
            'birth_date' => 'required|date',
        ];
    }
}