<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\ReasonRequest;
use App\Models\Administration\Reason;
use App\Models\Module\Module;
use App\SG\Administration\ReasonService;
use App\SG\ModulePropertiesInitializer;
use App\SG\ModuleServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;
use function response;
use function view;

class ReasonController extends Controller {

    protected $moduleId = 148;

    public function __construct(ModulePropertiesInitializer $moduleProperties) {
        parent::__construct($moduleProperties);

        $this->enableActivateFunctions(Reason::class, "R_Id", "R_Active");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $currentUser              = Auth::user();
        $viewData                 = $this->getDefaultViewData();
        $viewData["functions"]    = Module::ModuleUserFunctionList($this->moduleId, $currentUser->U_User_id, 'outside')->get();
        $viewData["headerAccess"] = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'header')->get();

        return view('administration.reason.index', $viewData);
    }

    public function datatable(ModuleServices $moduleServices) {
        $currentUser = Auth::user();
        $tableAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'outside')->get();

        $datatable = Datatables::of(Reason::query())
                ->setRowId('R_Id')
                ->make(true);

//        DB::enableQueryLog();
//        dd(DB::getQueryLog());

        $datatableAssoc         = $datatable->getData(true);
        $datatableAssoc["data"] = $moduleServices->appendInlineActions($datatableAssoc["data"], $tableAccess);
        return response()->json($datatableAssoc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(ModuleServices $moduleServices) {

        $reason                   = new Reason();
        $reason->R_Module_id_list = "";

        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'create';
        $viewData['modules']  = $moduleServices->getModules(TRUE);
        $viewData['formData'] = $reason;

        return view('administration.reason.module', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ReasonRequest $request, ReasonService $reasonService) {

        try {
            $reason = new Reason();
            $this->requestToModel($reason, $request);

            return $reasonService->saveReason($reason);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(ModuleServices $moduleServices, $id) {
        $reason = Reason::FindWithIdList($id);

        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'edit';
        $viewData['modules']  = $moduleServices->getModules(TRUE);
        $viewData['formData'] = $reason;

        return view('administration.reason.module', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ReasonRequest $request, ReasonService $reasonService, $id) {

        try {
            $reason = Reason::find($id);
            $this->requestToModel($reason, $request);

            return $reasonService->saveReason($reason);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        try {
            $reason = Reason::find($id);
            $reason->delete();
            return "OK";
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    private function requestToModel(&$model, $request) {

        $input = $request->input();

        $model->R_Id             = $input["R_Id"];
        $model->R_Description    = $input["R_Description"];
        $model->R_Module_id_list = $input["R_Module_id_list"];

        return $model;
    }

}
