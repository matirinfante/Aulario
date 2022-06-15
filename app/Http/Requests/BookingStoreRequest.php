<?php

namespace App\Http\Requests;

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
            'id_user'=>['required'],
            'participants'=>['required','integer'],
            'description'=>['required','string'],
            'booking_date'=>['required',new CheckTwoWeeks],
            'start_time'=>['required','date_format:H:i:s','before:finish_time'],
            'finish_time'=>['required']
        ];
    }
    public function attributes()
    {
        return[
            'participants'=>'cantidad participantes',
            'description'=>'descripción',
            'booking_date'=>'fecha',
            'start_time'=>'hora inicio',
            'finish_time'=>'hora fin',
        ];
    }
    
}
