<?php

namespace App;

use App\SG\SearchableByEncryptedId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SGModel extends Model {

    use SearchableByEncryptedId;

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    public function scopeWithFields($query, $fields) {
        return $query->select($fields);
    }

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

}
