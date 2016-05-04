<?php

namespace App\Http\Controllers\FinancialManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinancialManagementController extends Controller {

    protected $moduleId = 3;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
//        DB::enableQueryLog();
//        dd(DB::getQueryLog());

        return view('financial_management/index', $this->getDefaultViewData());
    }

}
