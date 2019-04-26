<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArquivoPrincipalRequest extends FormRequest
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

            'loanid'=>'required|exists:client_details',
            'nform'=>'required',
            'apoliceseguro'=>'required',
            'nuit'=>'required',
            'bi'=>'required',
            'lficheiro'=>'required',
            'fsalario'=>'required',
            'tprovimento'=>'required',
            'status'=>'required',
            'observacao'=>'',
            'npaginas'=>'',
            'idusuario'=>'required',
            'extrato'=>'required',
            'nib'=>'required',
            'dsalario'=>'required',
            'outros'=>'required',

        ];
    }
}
