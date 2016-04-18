<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFunction extends Model {

    protected $primaryKey = ["UF_FK_User_id", "UF_FK_Function_id", "UF_FK_Module_id"];
    protected $table      = "tblCOM_UserFunction";
    public $incrementing  = false;

    public function moduleFunction() {
        return $this->belongsTo("App\ModuleFunction", "UF_FK_Function_id", "F_Function_id");
    }

}
