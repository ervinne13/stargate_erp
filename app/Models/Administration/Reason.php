<?php

namespace App\Models\Administration;

use App\Models\SGModel;
use Illuminate\Support\Facades\DB;

/**
 * uses string_agg
 */
class Reason extends SGModel {

    protected $primaryKey = "R_Id";
    protected $table      = 'tblCOM_Reason';
    public $incrementing  = false;

    public function reasonModules() {
        return $this->hasMany(ReasonModules::class, 'RM_FK_Reason_id');
    }

    public function scopeFindWithIdList($query, $id) {
        return $query->select([
                            "R_Id",
                            "R_Description",
                            "R_Active",
                            DB::raw('string_agg("RM_FK_Module_id"::text, \',\') AS "R_Module_id_list"')
                        ])
                        ->where("R_Id", $id)
                        ->leftJoin('tblCOM_ReasonModule', 'RM_FK_Reason_id', '=', 'R_Id')
                        ->groupBy("R_Id")
                        ->first();
    }

}
