<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^([a-zA-Z\sÁÉÍÓÚáéíóúÑñ]+)$/'],   
            'surname' => ['required', 'regex:/^([a-zA-Z\sÁÉÍÓÚáéíóúÑñ]+)$/'],
            'dni' => ['required','digits_between:7,8', Rule::unique('users')->ignore($this->dni,'dni')], //Rule: Regla de validación personalizada 
            'email' => ['required', Rule::unique('users')->ignore($this->email,'email'), 'email'], 
            'role' => ['required'], 
        ];
    }
    public function attributes()
    {
        return[
            'name'=>'nombre',
            'surname'=>'apellido',
        ];
    }
    public function messages(){
        return [
            'name.regex'=>'El nombre solo puede contener letras y espacios.',
            'surname.regex'=>'El apellido solo puede contener letras y espacios.',
            'dni.unique'=>'El dni ingresado ya existe.',
            'dni.digits_between'=>'El dni debe ser un número de 7 u 8 digitos.',
            'email.unique'=>'El email ingresado ya existe.',
        ];
    }
}
