<?php

namespace App\Models\Module;

use App\Models\User\UserProfile;
use Illuminate\Database\Eloquent\Model;

/**
 * FIXME: move this to modules namespace
 */
class UserAccess extends Model {

    protected $primaryKey = "UA_Access_id";
    protected $table      = "tblCOM_UserAccess";
    public $incrementing  = false;
    //
    //  disable timestamps
    public $timestamps    = false;

    public function userProfile() {
        return $this->belongsTo(UserProfile::class, "UP_FK_Access_id", "UA_Access_id");
    }

    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Scopes">

    public function scopeUserId($query, $userId) {
        return $query
                        ->join('tblCOM_UserProfile', 'UP_FK_Access_id', '=', 'UA_Access_id')
                        ->where('UP_FK_User_id', $userId);
    }

    public function scopeHeader($query) {
        return $query->where("UA_Header", 1);
    }

    //  </editor-fold>
}
