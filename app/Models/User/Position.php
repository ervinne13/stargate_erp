<?php

namespace App\Models\User;

use App\Models\SGModel;

class Position extends SGModel {

    protected $primaryKey = "P_Position_id";
    protected $table      = 'tblCOM_Position';
    public $incrementing  = false;

    public function scopeType($query, $type) {
        return $query->where('P_Type', $type);
    }

}
