<?php

namespace App\Http\Controllers\FinancialManagement;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CashAdvanceController extends Controller {

    //  TODO: add for HRIS
    protected $moduleIdMap = [
        "sales-operation"      => 63,
        "warehouse-management" => 117,
    ];

    public function index() {
        return "bisaya";
    }

    public function create() {
//        $user = new User();
//
//        $user->U_Location_id_list = "";
//
//        $viewData              = $this->getDefaultViewData();
//        $viewData['mode']      = 'create';
//        $viewData["roles"]     = Position::all();
//        $viewData["locations"] = StoreProfile::select(["SP_StoreID", "SP_StoreName"])->get();
//        $viewData['formData']  = $user;

        return view('administration.users.create', $viewData);
    }

}
