<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => ['required','current_password'],
            'new_password' => ['required','confirmed'],
            'new_password_confirmation' => ['required'],
        ];
    }

    public function attributes()
    {
        return[
            'old_password'=>'contraseña actual',
            'new_password'=>'contraseña nueva',
            'new_password_confirmation'=>'confirmación de contraseña',            
        ];
    }
    public function messages(){
        return [
            'old_password.current_password'=>'La contraseña ingresado no coincide con la actual',
        ];
    }
}
