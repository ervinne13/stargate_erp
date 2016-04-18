<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAccess extends Model {

    protected $primaryKey = ["CA_FK_User_id", "CA_FK_Location_id"];
    protected $table      = 'tblCOM_CompanyAccess';
    public $incrementing  = false;

    public function storeProfile() {
        return $this->belongsTo('App\StoreProfile', 'CA_FK_Location_id');
    }

}
