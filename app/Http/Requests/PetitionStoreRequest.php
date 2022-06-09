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
            // 'estimated_people' => ['required'],
            // 'start_time' =>['required'],
            // 'finish_time' => ['required'],
        ];
    }
}
