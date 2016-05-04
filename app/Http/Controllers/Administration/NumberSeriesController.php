<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\NumberSeriesRequest;
use App\Models\Administration\StoreProfile;
use App\Models\Module\Module;
use App\Models\Module\NumberSeries;
use App\SG\ModuleServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class NumberSeriesController extends Controller {

    protected $moduleId = 16;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $currentUser  = Auth::user();
        $headerAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'header')->get();
        $viewData     = array_merge($this->getDefaultViewData(), [
            'headerAccess' => ["accessList" => $headerAccess]
        ]);

        return view('administration.numberseries.index', $viewData);
    }

    public function datatable(ModuleServices $moduleServices) {
        $currentUser = Auth::user();
        $tableAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'outside')->get();

        $datatable = Datatables::of(NumberSeries::datatable())
                ->setRowId('NS_Id')
                ->make(true);

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
        $numberSeries = new NumberSeries();

        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'create';
        $viewData['formData'] = $this->initializeFormData($moduleServices, $numberSeries);

        return view('administration.numberseries.module', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(NumberSeriesRequest $request) {
        try {
            $numberSeries = new NumberSeries();
            $this->requestToModel($numberSeries, $request);
            $numberSeries->save();
            return $numberSeries;
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
    public function show(ModuleServices $moduleServices, $id) {
        $numberSeries = NumberSeries::EncryptedId($id);

        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'view';
        $viewData['formData'] = $this->initializeFormData($moduleServices, $numberSeries);

        return view('administration.numberseries.module', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(ModuleServices $moduleServices, $id) {
        $numberSeries = NumberSeries::EncryptedId($id);

        $viewData             = $this->getDefaultViewData();
        $viewData["id"]       = $id;
        $viewData['mode']     = 'edit';
        $viewData['formData'] = $this->initializeFormData($moduleServices, $numberSeries);

        return view('administration.numberseries.module', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(NumberSeriesRequest $request, $id) {

        try {
            $numberSeries = NumberSeries::EncryptedId($id);
            $this->requestToModel($numberSeries, $request);
            $numberSeries->save();
            return $numberSeries;
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
            $numberSeries = NumberSeries::EncryptedId($id);
            $numberSeries->delete();
            return "Successfully deleted!";
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    private function initializeFormData(ModuleServices $moduleServices, $numberSeries) {
        $formData              = $numberSeries;
        $formData['modules']   = $moduleServices->getModules(true);
        $formData['locations'] = StoreProfile::active()->get();

        return $formData;
    }

    private function requestToModel(&$model, $request) {
        $model->NS_Id           = $request->input('NS_Id');
        $model->NS_Description  = $request->input('NS_Description');
        $model->NS_FK_Module_id = $request->input('NS_FK_Module_id');
        $model->NS_Location     = $request->input('NS_Location');
        $model->NS_StartNo      = $request->input('NS_StartNo');
        $model->NS_EndingNo     = $request->input('NS_EndingNo');

        return $model;
    }

}
