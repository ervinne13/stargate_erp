<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    protected $primaryKey = "A_Code";
    protected $table      = 'tblCOM_Attribute';
    public $incrementing  = false;

    public function details() {
        return $this->hasMany(AttributeDetail::class, 'AD_FK_Code');
    }

}
