<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model {

    protected $primaryKey = "UA_Access_id";
    protected $table      = "tblCOM_UserAccess";
    public $incrementing  = false;

    public function userProfile() {
        return $this->belongsTo("App\UserProfile", "UP_FK_Access_id", "UA_Access_id");
    }

}
