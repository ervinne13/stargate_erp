<?php

namespace App\Models\Administration;

use App\Models\SGModel;

class CompanyAccess extends SGModel {

    protected $primaryKey = ["CA_FK_User_id", "CA_FK_Location_id"];
    protected $table      = 'tblCOM_CompanyAccess';
    public $incrementing  = false;

    public function storeProfile() {
        return $this->belongsTo(StoreProfile::class, 'CA_FK_Location_id');
    }

}
