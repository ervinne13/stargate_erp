<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleFunction extends Model {

    protected $primaryKey = "F_Function_id";
    protected $table      = "tblCOM_Function";
    public $incrementing  = false;

}
