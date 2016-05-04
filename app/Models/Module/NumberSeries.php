<?php

namespace App\Models\Module;

use App\Models\SGModel;
use Illuminate\Support\Facades\DB;

class NumberSeries extends SGModel {

    protected $primaryKey = "NS_Id";
    protected $table      = 'tblCOM_NoSeries';
    public $incrementing  = false;

    public function module() {
        return $this->belongsTo(Module::class, 'NS_FK_Module_id');
    }

    public function scopeDatatable($query) {

        $columns = [
            DB::raw('md5("NS_Id") AS id'),
            'NS_Id',
            'NS_Description',
            'NS_FK_Module_id',
            'NS_StartNo',
            'NS_EndingNo',
            'NS_Location',
            'NS_LastNoUsed',
            'NS_LastDateUsed',
            'M_Description'
        ];

        return $query
                        ->select($columns)
                        ->join('tblCOM_Module', 'NS_FK_Module_id', '=', 'M_Module_id')
        ;
    }

}
