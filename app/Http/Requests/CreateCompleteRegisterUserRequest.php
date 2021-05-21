<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompleteRegisterUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'address' => 'required|string|max:191',
            'telephone' => 'string|max:50',
            'cellphone' => 'required|string|max:50',
            'id_user' => 'required|string|max:50',
        ];
    }

    public function messages (){
        return [  
            'address.required' => 'O Campo de endereço é obrigatório',
            'telephone' => '',
            'cellphone.required' => 'O celular é obrigatório',
            'id_user' => '',
        ];
    }
}
