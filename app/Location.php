<?php

use App\SGModel;

namespace App;

class Location extends SGModel {

    protected $primaryKey = ["CA_FK_User_id", "CA_FK_Location_id"];
    protected $table      = 'tblCOM_CompanyAccess';
    public $incrementing  = false;

    public function scopeUser($query, $userId) {
        return $query
                        ->leftJoin('tblINV_StoreProfile', 'SP_StoreID', '=', 'CA_FK_Location_id')
                        ->where('CA_FK_User_id', $userId)
        ;
    }

    public function scopeUserDefault($query, $userId) {
        return $query
                        ->leftJoin('tblINV_StoreProfile', 'SP_StoreID', '=', 'CA_FK_Location_id')
                        ->where('CA_DefaultLocation', 1)
                        ->where('CA_FK_User_id', $userId)
        ;
    }

}
