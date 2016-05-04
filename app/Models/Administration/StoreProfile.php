<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class StoreProfile extends Model {

    protected $primaryKey = 'SP_StoreID';
    protected $table      = 'tblINV_StoreProfile';
    public $incrementing  = false;

    public function scopeActive() {
        return $this->where("SP_Active", 1);
    }

}
