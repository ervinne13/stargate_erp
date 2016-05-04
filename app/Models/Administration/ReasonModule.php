<?php

namespace App\Models\Administration;

use App\Models\SGModel;
use Illuminate\Database\Eloquent\Model;

class ReasonModule extends SGModel {

    protected $primaryKey = ["RM_FK_Reason_id", "RM_FK_Module_id"];
    protected $table      = 'tblCOM_ReasonModule';
    public $incrementing  = false;
    public $timestamps    = false;

    //  disable SG Model Auto Saving 
    public static function boot() {
        Model::boot();
    }

}
