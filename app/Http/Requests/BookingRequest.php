<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            //Definir campos requeridos
            // 'assignment_id' => 'integer',
            // 'event_id' => 'integer',
            // 'user_id' => 'required|integer',
            // 'description' => 'string',
            // 'start_time' => 'required',
            // 'finish_time' => 'required'
        ];
    }
}
