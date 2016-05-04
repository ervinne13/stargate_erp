<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;

class AdministrationController extends Controller {

    protected $moduleId = 1;

    public function index() {
        return view('administration/index', $this->getDefaultViewData());
    }

}
