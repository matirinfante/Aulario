<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
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
            'assignment_name' => ['required','regex:/^([a-zA-Z\sÁÉÍÓÚáéíóúÑñ]+)$/'], 
            'start_date' => ['required','before:finish_date'],
            'finish_date' => ['required'],
        ];
    }
    public function attributes()
    {
        return [            
            'assignment_name'=>'materia',
            'day'=>'dias',
            'start_date'=>'fecha inicio',
            'finish_date'=>'fecha fin'
        ];
    }
    public function messages(){
        return [
            'assignment_name.regex'=>'El nombre solo puede contener letras y espacios.',
            'start_date.before'=>'La fecha de inicio debe ser anterior a la fecha de fin.',
        ];
    }
}
