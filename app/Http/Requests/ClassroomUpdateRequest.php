<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomUpdateRequest extends FormRequest
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
            // Definir campos requeridos
            // 'classroom_name'=> ['required','alpha_num','unique:classrooms,classroom_name,' . $this->classroom->id],
            // 'location' => ['required'],
            // 'capacity' => ['required','integer'],
            // 'type' => ['required'], // in:Laboratorio, Aula común' como es la entrada por form
            // 'building' => ['required','alpha'],
            // 'available_start' => ['required'],
            // 'available_finish' => ['required'],
        ];
    }
}
