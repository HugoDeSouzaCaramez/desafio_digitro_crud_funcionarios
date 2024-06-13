<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkingHourRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'employer_id' => 'required',
            'date' => 'required|date|unique:working_hours,date,NULL,id,employer_id,' . $this->employer_id,
            'hours_worked' => 'required|integer|min:0|max:99999',
        ];
    }
}