<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

    protected $primaryKey = ["UP_FK_Module_id", "UP_FK_User_id", "UP_FK_Access_id"];
    protected $table      = "tblCOM_UserProfile";
    public $incrementing  = false;

    public function userAccess() {
        return $this->hasOne("App\UserAccess", "UA_Access_id", "UP_FK_Access_id");
    }

    public function scopeUserId($query, $userId) {
        return $query->where("UP_FK_User_id", $userId);
    }

}
