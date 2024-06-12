<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $employerId = $this->route('employer');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:employers,email,' . $employerId,
            'cpf' => 'required|regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/|unique:employers,cpf,' . $employerId,
            'birth_date' => 'required|date',
        ];
    }
}