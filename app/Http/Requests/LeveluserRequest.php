<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeveluserRequest extends FormRequest
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
            
            'id'=>'',
            'fk_user_id'=>'',
            'discricao' => 'required|string|max:20|unique:leveluser',
            'detalhes'=>'required|string|max:100',
            'phone' => 'max:9',

        ];
    }
}
