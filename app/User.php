<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {

    protected $primaryKey = "U_User_id";
    protected $table      = 'tblCOM_User';
    public $incrementing  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'U_User_id', 'U_Username', 'U_Password2',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword() {
        return $this->attributes['U_Password2'];
    }

    public function position() {
        return $this->hasOne('App\Position', 'P_Position_id', 'U_FK_Position_id');
    }

    public function access() {
        return $this->hasMany('App\UserProfile', 'UP_FK_User_id', 'U_User_id');
    }

    public function scopeDatatable($query, $moduleId) {
        $relevantColumns = [
            "U_User_id",
            "U_Username",
            "U_FK_Position_id",
            "U_Status",
        ];

        $positionFilter = function($query) {
            $query->addSelect(["P_Position_id", "P_Position", "P_Parent"]);
        };

        $userAccessFilter = function($query) use($moduleId) {
            $query->addSelect(["UA_Access_id", "UA_AccessName", "UA_Trigger", "UA_Icon", "UA_Inside", "UA_Outside", "UA_Header", "UA_Inline", "UA_Get", "UA_TriggerInside", "UA_GetInside"]);
            $query->where('UA_FK_Module_id', $moduleId);
        };

        $accessFilter = function($query) use($moduleId, $userAccessFilter) {
            $query->with(['userAccess' => $userAccessFilter]);
            $query->addSelect(["UP_FK_Access_id", "UP_FK_User_id", "UP_FK_Module_id"]);
            $query->where('UP_FK_Module_id', $moduleId);
        };

        return $query
                        ->select($relevantColumns)
                        ->with(['position' => $positionFilter])
                        ->with(['access' => $accessFilter])
//                        ->with(['access.userAccess' => $userAccessFilter])
        ;
    }

}
