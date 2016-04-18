<?php

namespace App\SG;

use Illuminate\Support\Facades\DB;

/**
 * Description of SearchableByEncryptedId
 *
 * @author Ervinne Sodusta
 */
trait SearchableByEncryptedId {

    public function scopeEncryptedId($query, $id) {
        return $query->where(DB::raw('md5("' . $this->primaryKey . '")'), $id)->first();
    }

}
