<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model {

    protected $primaryKey = "P_Position_id";
    protected $table      = 'tblCOM_Position';
    public $incrementing  = false;

}
