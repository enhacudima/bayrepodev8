<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarEstadoRequest extends FormRequest
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

            'novoestado'=>'required',
            'idsolicitacao'=>'required',
            'comentarios'=>'required|string|min:3|max:255',
            'idusuario'=>'required',
            'datafinalizacao'=>'string|required',
        ];
    }
}
