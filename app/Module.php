<?php

namespace App;

use Illuminate\Support\Facades\DB;

/**
 * Database specific functions:
 * Postgres
 *  scopeSelectableByDescription - DISTINCT ON
 */
class Module extends SGModel {
    /*
     * Note: Edit access can only be applicable to Open documents     
     */

    protected $primaryKey = "M_Module_id";
    protected $table      = 'tblCOM_Module';
    public $incrementing  = false;

    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Scopes">

    /**
     * Scope that retrieves the list of access from tblCOM_UserAccess based on 
     * the given module and user id.
     * @param Integer $moduleId
     * @param String $userId
     * @param String $accessLocation
     *      The type of access location needed. Can be header, inside, or outside.     
     */
    public function scopeUserAccessList($query, $userId) {

        $userAccessFilter = function($query) {
            return $query->select('UA_AccessName', 'UA_Trigger', 'UA_Icon', 'UA_Access_id');
        };

        $userProfileFilter = function($query) use ($userId, $userAccessFilter) {
            return $query
                            ->select('UP_FK_User_id', 'UP_FK_Module_id', 'UP_FK_Access_id')
                            ->where('UP_FK_User_id', $userId)
                            ->with(['userAccess' => $userAccessFilter])
            ;
        };

        $moduleFunctionFilter = function($query) {
            return $query->select('F_Function_id', 'F_FunctionName');
        };

        $userFunctionFilter = function($query) use ($userId, $moduleFunctionFilter) {
            $query
                    ->select('UF_FK_User_id', 'UF_FK_Function_id', 'UF_FK_Module_id')
                    ->where('UF_FK_User_id', $userId)
                    ->with(['moduleFunction' => $moduleFunctionFilter])
            ;
        };

        return $query
                        ->active()
                        ->with(['userProfile' => $userProfileFilter])
                        ->with(['userFunction' => $userFunctionFilter])
                        ->orderBy('M_Module_id')
        ;
    }

    public function scopeAccessAndFunctions($query, $accessFilters = ['Add', 'Edit', 'Delete']) {

        $moduleFunctionFilter = function($query) {
            return $query->select('F_FK_Module_id', 'F_Function_id', 'F_FunctionName');
        };

        $userAccessFilter = function($query) use ($accessFilters) {
            return $query
                            ->select('UA_FK_Module_id', 'UA_AccessName')
                            ->whereIn('UA_AccessName', $accessFilters)
            ;
        };

        return $query
                        ->select(["M_Module_id", "M_Description"])
                        ->with(['moduleFunction' => $moduleFunctionFilter])
                        ->with(['userAccess' => $userAccessFilter])
        ;
    }

    /**
     * Scope that retrieves the list of access from tblCOM_UserAccess based on 
     * the given module and user id.
     * @param Integer $moduleId
     * @param String $userId
     * @param String $accessLocation
     *      The type of access location needed. Can be header, inside, or outside.     
     */
    public function scopeModuleUserAccessList($query, $moduleId, $userId, $accessLocation = null) {
        $queryBuilder = $query
                ->join('tblCOM_UserAccess', 'UA_FK_Module_id', '=', 'M_Module_id')
                ->join('tblCOM_UserProfile', 'UP_FK_Access_id', '=', 'UA_Access_id')
                ->where('M_Module_id', $moduleId)
                ->where('UP_FK_User_id', $userId);

        if ($accessLocation == 'header') {
            $queryBuilder = $queryBuilder->where("UA_Header", 1);
        }

        if ($accessLocation == 'inside') {
            $queryBuilder = $queryBuilder->where("UA_Inside", 1)->whereNull("UA_Header");
        }

        if ($accessLocation == 'outside') {
            $queryBuilder = $queryBuilder->where("UA_Outside", 1)->whereNull("UA_Header");
        }

        return $queryBuilder;
    }

    public function scopeNonHeader($query) {
        return $query
                        ->where('M_Header', 0)
                        ->where('M_Parent', '!=', 0)
        ;
    }

    public function scopeSelectableByDescription($query) {

        $columns = [
            DB::raw('DISTINCT ON("M_Description") "M_Module_id"'),
            'M_Description'
        ];

        return $query
                        ->select($columns)
                        ->where('M_Header', 0)
                        ->where('M_Parent', '!=', 0)
                        ->orderBy('M_Description')
                        ->orderBy('M_Module_id')
        ;
    }

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Relationships">   

    public function scopeActive($query) {
        return $query->where("M_Active", 1);
    }

    public function moduleParent() {
        return $this->belongsTo('App\Module', 'M_Parent', 'M_Module_id');
    }

    public function moduleChildren() {
        return $this->hasMany('App\Module', 'M_Parent', 'M_Module_id')->orderBy('M_Module_id');
    }

    public function scopeHeaders($query) {
        return $query
                        ->where('M_Header', 1)
                        ->where('M_Parent', 0)
                        ->orderBy('M_Module_id')
        ;
    }

    public function moduleFunction() {
        return $this->hasMany('App\ModuleFunction', 'F_FK_Module_id');
    }

    public function userFunction() {
        return $this->hasMany('App\UserFunction', 'UF_FK_Module_id');
    }

    public function userProfile() {
        return $this->hasMany('App\UserProfile', 'UP_FK_Module_id');
    }

    public function userAccess() {
        return $this->hasMany('App\UserAccess', 'UA_FK_Module_id');
    }

    //  </editor-fold>
}
