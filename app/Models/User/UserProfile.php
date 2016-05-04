<?php

namespace App\Models\User;

use App\Models\Module\UserAccess;
use App\Models\SGModel;

class UserProfile extends SGModel {

    protected $primaryKey = ["UP_FK_Module_id", "UP_FK_User_id", "UP_FK_Access_id"];
    protected $table      = "tblCOM_UserProfile";
    public $incrementing  = false;

    public function userAccess() {
        return $this->hasOne(UserAccess::class, "UA_Access_id", "UP_FK_Access_id");
    }

    public function scopeUserId($query, $userId) {
        return $query->where("UP_FK_User_id", $userId);
    }

}
