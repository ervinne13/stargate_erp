<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\SG\ModuleServices;

class AdministrationController extends Controller {

    public function index() {
        return view('administration/index', $this->getDefaultViewData());
    }

}
