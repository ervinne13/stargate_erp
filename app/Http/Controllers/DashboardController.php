<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller {

    public function index() {

        $users = User::all();

        Log::info($users);

        return $users;
    }

}
