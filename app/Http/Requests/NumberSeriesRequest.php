<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NumberSeriesRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = [
            'NS_Description'  => 'required|max:30',
            'NS_FK_Module_id' => 'required|numeric',
            'NS_Location'     => 'required|max:30',
            'NS_StartNo'      => 'required|numeric',
            'NS_EndingNo'     => 'required|numeric'
        ];

        if ($this->method() == 'POST') {
            $rules['NS_Id'] = "required|unique:tblCOM_NoSeries,NS_Id|max:30";
        }

        return $rules;
    }

}
