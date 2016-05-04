<?php

namespace App\Http\Requests\Administration;

use App\Http\Requests\Request;

class ReasonRequest extends Request {

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
            "R_Description"    => "required|max:30",
            "R_Module_id_list" => "required"
        ];

        if ($this->method() == 'POST') {
            $rules['R_Id'] = "required|unique:tblCOM_Reason,R_Id|max:30";
        }

        return $rules;
    }

}
