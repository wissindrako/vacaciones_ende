<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionVacacion extends FormRequest
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
            'inicio' => 'required|date|date_format:d-m-Y',
            'fin' => 'required|date|date_format:d-m-Y|after_or_equal:inicio',
            'tiempo_id' => 'required'
        ];
    }
}
