<?php

namespace sisventas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use sisventas\Http\Requests\Requests;

class CategoriaFormRequest extends FormRequest
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
            //Aqui vamos a agregar las reglas
            'nombre'=>'required|max:45',
            'descripcion'=>'max:256',
        ];
    }
}
