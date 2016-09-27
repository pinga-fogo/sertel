<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccountRequest extends Request
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
        $input = $this->all();
        $id = (isset($input['id']) && is_numeric($input['id'])) ? trim($input['id']) : '0';

        $input['email'] = trim($input['email']);
        $input['name'] = trim($input['name']);
        $input['lastname'] = trim($input['lastname']);

        $regras = [
            'email' => 'required|unique:users,email,'.$id.'|email',
            'role' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'name' => 'required|min:3',
            'lastname' => 'min:3'
        ];

        if(!isset($input['password'])){
            unset($regras['password']);
            unset($regras['password_confirmation']);
        }
        // dd($regras);

        return $regras;
    }
}
