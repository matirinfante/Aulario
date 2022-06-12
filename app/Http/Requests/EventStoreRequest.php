<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'event_name' => ['required',  'regex:/^([a-zA-Z\s{0-9}ÁÉÍÓÚáéíóúÑñ]+)$/'],
            'participants' => ['required','integer']
        ];
    }
    public function messages(){
        return [
            'event_name.regex: El nombre solo puede contener letras, números y espacios.',
        ];
    }
}
