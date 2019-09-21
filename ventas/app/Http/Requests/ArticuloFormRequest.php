<?php

namespace sisventas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest
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
            'idcategoria'=>'required',
            'codigo'=>'required|max:45',
            'nombre'=>'required|max:100',
            'stock'=>'required|max:11',
            'descripcion'=>'max:512',
            'imagen'=>'mimes:jpeg,bmp,png,jpg'
        ];
    }
}
