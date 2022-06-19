<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckTwoWeeks;

class BookingStoreRequest extends FormRequest
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
            'participants' => ['required', 'numeric'],
            'start_time' => ['required', 'date_format:H:i', 'before:finish_time'],
            'finish_time' => ['required'],
            //Event
            'event_name' => ['sometimes','required',  'regex:/^([a-zA-Z\s{0-9}ÁÉÍÓÚáéíóúÑñ]+)$/'],
            'description' => ['sometimes','required', 'string'], 
            'booking_date' => ['sometimes','required', new CheckTwoWeeks()],
            //Asignment
            'assignment_id'=>['sometimes','required'],
            'day'=>['sometimes','requered'],            
            'start_date' => ['sometimes','required','before:finish_date',new CheckTwoWeeks()],
            'finish_date' => ['sometimes','required'],
        ];
    }

    public function attributes()
    {
        return [
            'participants' => 'cantidad participantes',
            'description' => 'descripción',
            'booking_date' => 'fecha',
            'start_time' => 'hora inicio',
            'finish_time' => 'hora fin',
            'event_name'=>'nombre de evento',
            'assignment_id'=>'materia',
            'day'=>'dias',
            'start_date'=>'fecha inicio',
            'finish_date'=>'fecha fin'
        ];
    }
    public function messages(){
        return [
            'event_name.regex: El nombre solo puede contener letras, números y espacios.',
            'start_date.before'=>'La fecha de inicio debe ser anterior a la fecha de fin.',
            'start_time.before'=>'La hora de inicio debe ser anterior a la hora de fin.',
        ];
    }

}
