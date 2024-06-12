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
            'name' => 'required|max:60',
            'email' => 'required|email|max:60|unique:employers',
            'cpf' => 'required|unique:employers|regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
            'birth_date' => 'required|date',
        ];
    }
}