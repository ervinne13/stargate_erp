<?php

namespace App\Http\Requests\Administration;

use App\Http\Requests\Request;

class RoleRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        //  TODO: change this to admin only role
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "P_Position" => "required|max:255",
            "P_Type"     => "required|max:30",
        ];
    }

}
