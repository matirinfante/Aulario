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
        if (auth()->user()->hasRole('admin')) {
            if ($this->has('assignment_id')) {
                return [
                    'assignment_id' => ['exclude_with:event_name', 'required'],
                    'participants' => ['exclude_with:event_name', 'required', 'numeric'],
                    'start_date' => ['exclude_with:event_name', 'required', 'before:finish_date'],
                    'finish_date' => ['exclude_with:event_name', 'required']
                ];
            } else if ($this->has('event_name')) {
                return [
                    'participants_event' => ['required_without_all:assignment_id,participants,strat_date,finish_date', 'required', 'numeric'],
                    'event_name' => ['required_without_all:assignment_id,participants,strat_date,finish_date', 'required', 'regex:/^([a-zA-Z\s{0-9}ÁÉÍÓÚáéíóúÑñ]+)$/'],
                    'description' => ['required_without_all:assignment_id,participants,strat_date,finish_date', 'required', 'string'],
                    'booking_date' => ['required_without_all:assignment_id,participants,strat_date,finish_date', 'required']
                ];
            }
        } else {
            return [
                'participants' => ['required_without_all:assignment_id,participants,strat_date,finish_date', 'required', 'numeric'],
                'event_name' => ['required_without_all:assignment_id,participants,strat_date,finish_date', 'required', 'regex:/^([a-zA-Z\s{0-9}ÁÉÍÓÚáéíóúÑñ]+)$/'],
                'description' => ['required_without_all:assignment_id,participants,strat_date,finish_date', 'required', 'string'],
                'booking_date' => ['required_without_all:assignment_id,participants,strat_date,finish_date', 'required', new CheckTwoWeeks()]
            ];
        }
        
        
    }

    public function attributes()
    {
        if ($this->has('assignment_id')) {
            return [
                'assignment_id' => 'materia',
                'start_date' => 'fecha inicio',
                'finish_date' => 'fecha fin',
                'participants' => 'cantidad participantes'
            ];
        } else {
            return [
                'participants_event' => 'cantidad participantes al evento',
                'description' => 'descripción',
                'booking_date' => 'fecha',
                'start_time' => 'hora inicio'
            ];
        }
    }
    public function messages()
    {
        return [
            'event_name.regex: El nombre solo puede contener letras, números y espacios.',
            'start_date.before' => 'La fecha de inicio debe ser anterior a la fecha de fin.',
        ];
    }
}
