<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required','alpha'],
            'surname' => ['required','alpha'],
            'dni' => ['required','integer','min:10000000','max:99999999'],
            'email'=> ['required','unique:users,email,' . $this->user->id], 
        ];
    }
}
