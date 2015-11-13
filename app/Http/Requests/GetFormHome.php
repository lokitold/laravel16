<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class GetFormHome extends Request {

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
            "dateDesde"    =>    "date_format:Y-m-d H:i:s",
            "dateHasta"		 =>		 "date_format:Y-m-d H:i:s"
        ];
    }

    public function messages()
    {
        return [
            'dateDesde.date_format' => 'El campo Fecha Desde esta mal formada : Formato Y-m-d H:i:s!',
            'dateHasta.date_format' => 'El campo Fecha Hasta esta mal formada : Formato Y-m-d H:i:s! ',
        ];
    }
}