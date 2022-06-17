<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassroomStoreRequest extends FormRequest
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
            'classroom_name' => ['required','unique:classrooms','regex:/^([a-zA-Z-\s{0-9}]+)$/'],
            'location' => ['required'], //Que formato entra ??
            'capacity' => ['required','integer'],
            'type' => ['required'],
            'building' => ['required'],
        ];
    }

    public function attributes()
    {
        return[
            'classroom_name'=>'nombre del aula',
            'location'=>'locación',
            'capacity'=>'capacidad',
            'type'=>'tipo',
            'building'=>'edificio',
        ];
    }
    public function messages(){
        return [
            'classroom_name.regex'=>'El nombre solo puede contener letras, números y espacios.',
        ];
    }
}
