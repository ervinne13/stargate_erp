<?php

namespace App\SG\Administration;

use App\Models\Administration\Reason;

/**
 *
 * @author ervinne
 */
interface ReasonService {

    public function saveReason(Reason $reason);
}
