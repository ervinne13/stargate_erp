<?php

namespace App\Http\Requests\Administration;

use App\Http\Requests\Request;

class AttributeDetailRequest extends Request {

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
        return [
            'AD_Code'    => 'required|max:30',
            'AD_Desc'    => 'required|max:30',
            'AD_FK_Code' => 'required|max:30'
        ];
    }

}
