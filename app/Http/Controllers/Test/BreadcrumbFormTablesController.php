<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class BreadcrumbFormTablesController extends Controller {

    //  use User module id as module id
    protected $moduleId = 13;

    public function index() {
        $currentUser = Auth::user();

        $viewData                 = $this->getDefaultViewData();
        $viewData["roles"]        = Position::all();
        $viewData["locations"]    = StoreProfile::select(["SP_StoreID", "SP_StoreName"])->get();
        $viewData["functions"]    = Module::ModuleUserFunctionList($this->moduleId, $currentUser->U_User_id, 'outside')->get();
        $viewData["headerAccess"] = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'header')->get();

        return view('test.breadcrumb_form_tables', $viewData);
    }

    public function datatable(ModuleServices $moduleServices) {

        $currentUser = Auth::user();
        $tableAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'outside')->get();
        $datatable   = Datatables::of(User::datatable())
                ->setRowId('U_Username')
                ->make(true);

//        DB::enableQueryLog();
//        dd(DB::getQueryLog());

        $datatableAssoc         = $datatable->getData(true);
        $datatableAssoc["data"] = $moduleServices->appendInlineActions($datatableAssoc["data"], $tableAccess);

        return $datatableAssoc;
    }

}
