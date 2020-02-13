<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionPersona extends FormRequest
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
            'nombre' => 'required|max:50',
            'paterno' => 'required_without:materno|max:50',
            'materno' => 'required_without:paterno|max:50',
            'codigo' => 'required|max:15|unique:personas,codigo,' . $this->route('id'),
            'cargo' => 'max:60',
            'depto_seccion' => 'max:60',
            'haber_basico' => 'required|numeric|min:0',
            'fecha_ingreso' => 'required|date_format:d-m-Y'
        ];
    }
}
