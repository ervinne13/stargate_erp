<?php

namespace App\SG\Administration;

use App\Models\User\User;

/**
 *
 * @author ervinne
 */
interface UserService {

    public function save(User $user);
}
