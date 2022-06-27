<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetitionStoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer'],
            'assignment_id' => ['required', 'integer'],
            'estimated_people' => ['required', 'integer'],
            'classroom_type' => ['required', 'string'],
            'start_time' => ['required', 'date_format:H:i'],
            'finish_time' => ['required', 'date_format:H:i','after:start_time'],
            'start_date' => ['required', 'date_format:Y-m-d'],
            'finish_date' => ['required', 'date_format:Y-m-d','after:start_date'],
            'days' => ['required', 'string']
        ];
    }
    public function attributes()
    {
        return[
            'user_id' => 'usuario',
            'assignment_id' => 'materia',
            'estimated_people' => 'cantidad participantes',
            'classroom_type' => 'tipo',
            'start_time' => 'hora inicio',
            'finish_time' => 'hora fin',
            'start_date' => 'fecha inicio',
            'finish_date' => 'fecha fin',
            'days' => 'dias'
        ];
    }
}
