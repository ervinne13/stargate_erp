<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\NumberSeriesRequest;
use App\Module;
use App\NumberSeriesModel;
use App\SG\ModuleServices;
use App\StoreProfile;
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

        $datatable = Datatables::of(NumberSeriesModel::datatable())
                ->setRowId('NS_Id')
                ->make(true);

        $datatable["data"] = $moduleServices->appendInlineActions($datatable["data"], $tableAccess);

        return response()->json($datatable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $numberSeries = new NumberSeriesModel();

        $viewData             = $this->getDefaultViewData();
        $viewData['formData'] = $this->initializeFormData($numberSeries);

        return view('administration.numberseries.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(NumberSeriesRequest $request) {
        try {
            $numberSeries = new NumberSeriesModel();
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
    public function show($id) {
        $numberSeries = NumberSeriesModel::EncryptedId($id);

        $viewData                     = $this->getDefaultViewData();
        $viewData['formData']         = $this->initializeFormData($numberSeries);
        $viewData['formData']['mode'] = 'view';

        return view('administration.numberseries.view', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $numberSeries = NumberSeriesModel::EncryptedId($id);

        $viewData             = $this->getDefaultViewData();
        $viewData["uniqueId"] = $id;
        $viewData['formData'] = $this->initializeFormData($numberSeries);

        return view('administration.numberseries.edit', $viewData);
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
            $numberSeries = NumberSeriesModel::EncryptedId($id);
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
            $numberSeries = NumberSeriesModel::EncryptedId($id);
            $numberSeries->delete();
            return "Successfully deleted!";
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    private function initializeFormData($numberSeries) {
        $formData              = $numberSeries;
        $formData['modules']   = Module::SelectableByDescription()->get();
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
