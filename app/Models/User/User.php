<?php

namespace App\Models\User;

use App\Models\Administration\CompanyAccess;
use App\SG\SearchableByEncryptedId;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {

    use SearchableByEncryptedId;

    protected $primaryKey = "U_User_id";
    protected $table      = 'tblCOM_User';
    public $incrementing  = false;

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable          = [
        'U_User_id', 'U_Username', 'U_Password2',
    ];
    protected $JSONAllowedFields = [
        'U_User_id', 'U_Username', 'U_FK_Position_id', 'U_Status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($model) {
            $user              = Auth::user();
            $model->CreatedBy  = $user->U_User_id;
            $model->ModifiedBy = $user->U_User_id;
        });

        static::updating(function($model) {
            $user              = Auth::user();
            $model->ModifiedBy = $user->U_User_id;
        });
    }

    public function getAuthPassword() {
        return $this->attributes['U_Password2'];
    }

    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Relationships">

    public function position() {
        return $this->hasOne(Position::class, 'P_Position_id', 'U_FK_Position_id');
    }

    public function userProfile() {
        return $this->hasMany(UserProfile::class, 'UP_FK_User_id');
    }

    public function companyAccess() {
        return $this->hasMany(CompanyAccess::class, 'CA_FK_User_id');
    }

    /**
     * alias for companyAccess
     */
    public function locations() {
        return $this->companyAccess();
    }

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Scopes">

    public function scopeLocations($query) {
        return $query
                        ->select(['SP_StoreID', 'SP_StoreName', 'SP_Address', 'SP_FK_CompanyID'])
                        ->leftJoin('tblCOM_CompanyAccess', 'CA_FK_User_id', '=', 'U_User_id')
                        ->leftJoin('tblINV_StoreProfile', 'SP_StoreID', '=', 'CA_FK_Location_id')
                        ->where('U_User_id', $this->U_User_id)
        ;
    }

    public function scopeDefaultLocations($query) {
        return $this
                        ->scopeLocations($query, $this->U_User_id)
                        ->where('CA_DefaultLocation', 1)
        ;
    }

    public function scopeAccessList($query, $id) {

        $selectFields = [
            'UP_FK_User_id',
            'UA_Access_id',
            'UA_FK_Module_id',
            'UA_AccessName',
            'UA_Icon',
            "UA_Inside",
            "UA_Outside",
            "UA_Header",
            "UA_Inline",
            "UA_Get"
        ];

        //  use direct join instead of eager loaded relationships to prevent nesting
        //  of UserProfile and UserAccess as it is not needed
        return $query
                        ->select($selectFields)
                        ->where(DB::raw('md5("U_User_id")'), $id)
                        ->leftJoin('tblCOM_UserProfile', 'UP_FK_User_id', '=', 'U_User_id')
                        ->leftJoin('tblCOM_UserAccess', 'UA_Access_id', '=', 'UP_FK_Access_id')
                        ->orderBy("UA_FK_Module_id", "desc")
        ;
    }

    public function scopeDatatable($query) {
        $relevantColumns = [
            DB::raw('md5("U_User_id") AS id'),
            "U_User_id",
            "U_Username",
            "U_FK_Position_id",
            "U_Status",
        ];

        $positionFilter = function($query) {
            $query->addSelect(["P_Position_id", "P_Position", "P_Parent"]);
        };

        return $query
                        ->select($relevantColumns)
                        ->with(['position' => $positionFilter])
        ;
    }

    //  </editor-fold>
}
