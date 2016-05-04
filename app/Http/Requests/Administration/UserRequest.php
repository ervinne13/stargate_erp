<?php

namespace App\Http\Requests\Administration;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends Request {

    public function boot() {
        Validator::resolver(function($translator, $data, $rules, $messages, $attributes) {
            return new ValidatorExtended($translator, $data, $rules, $messages, $attributes);
        });
    }

    public function attributes() {

        return [
            'U_User_id'          => 'user id',
            'U_Username'         => 'full name',
            'U_Password'         => 'password',
            'U_Password_repeat'  => 'password',
            'U_FK_Position_id'   => 'position',
            'U_Location_id_list' => 'location',
        ];
    }

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
        $rules = [
            "U_Username"         => "required|max:100",
            "U_FK_Position_id"   => "required|max:30",
            "U_Location_id_list" => "required|max:30",
        ];

        if ($this->method() == 'POST') {
            $rules['U_User_id']         = "required|unique:tblCOM_User,U_User_id|max:30";
            $rules['U_Password']        = "required|max:100";
            $rules['U_Password_repeat'] = "required|max:100";
        }

        return $rules;
    }

}
