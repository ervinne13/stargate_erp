<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller {

    public function index() {

        $users = User::all();

        Log::info($users);

        return $users;
    }

    public function show($plainText) {

//        $user                   = new User();
//        $user->U_User_id        = "ervinne";
//        $user->U_Username       = "ervinne";
//        $user->U_FK_Position_id = "1001";
//        $user->U_Password      = bcrypt("password");
//        $user->U_Password2      = bcrypt("password");
//        $user->CreatedBy        = 1;
//        $user->ModifiedBy       = 1;
//        $user->U_Status         = 1;
//        $user->save();

        $user = Auth::user();

        var_dump($user);

        if (Auth::check()) {
            echo "ok";
        }

//        return$user->U_User_id;
    }

}
