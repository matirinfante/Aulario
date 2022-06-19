<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleStoreRequest extends FormRequest
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
            'classroom_id'=>['required'],
            'day' => ['required'], 
            'start_time' => ['required','date_format:H:i','before:finish_time'], 
            'finish_time' => ['required'],
        ];
    }
    public function attributes()
    {
        return[
            'classroom_id'=>'aula',
            'day' => 'dia', 
            'start_time' => 'hora inicio', 
            'finish_time' => 'hora fin',
        ];
    }
}
