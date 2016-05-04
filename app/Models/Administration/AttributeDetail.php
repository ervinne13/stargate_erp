<?php

namespace App\Models\Administration;

use App\Models\SGModel;

class AttributeDetail extends SGModel {

    protected $primaryKey = "AD_Id";
    protected $table      = 'tblCOM_AttributeDetail';
    public $incrementing  = false;

}
