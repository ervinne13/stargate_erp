<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\AttributeDetailRequest;
use App\Models\Administration\Attribute;
use App\Models\Administration\AttributeDetail;
use App\Models\Module\Module;
use App\SG\ModulePropertiesInitializer;
use App\SG\ModuleServices;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Facades\Datatables;

class AttributeDetailController extends Controller {

    //  Do not load default view data until an attribute id is given
    protected $lazyLoadsDefaultViewData = true;

    public function __construct(ModulePropertiesInitializer $moduleProperties) {
        parent::__construct($moduleProperties);

        $this->enableActivateFunctions(AttributeDetail::class, "AD_Id", "AD_Active");
    }

    public function index($attributeId) {
        $attribute = Attribute::find($attributeId);

        if ($attribute) {
            $currentUser = Auth::user();

            $this->moduleId = $attribute->A_FK_Module_id;
            $currentModule  = $this->getCurrentModule();

            $headerAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'header')->get();
            for ($i = 0; $i < count($headerAccess); $i ++) {
                if (strtolower($headerAccess[$i]->UA_AccessName) == "add") {
                    $headerAccess[$i]->UA_AccessName = "create";
                    $headerAccess[$i]->UA_Trigger    = $currentModule->M_Trigger . "/create";
                }
            }

            $viewData                 = $this->getDefaultViewData();
            $viewData["attribute"]    = $attribute;
            $viewData["headerAccess"] = $headerAccess;
            $viewData["functions"]    = Module::ModuleUserFunctionList($this->moduleId, $currentUser->U_User_id, 'outside')->get();
            return view('administration.attribute.index', $viewData);
        } else {
            return response("Attribute not found", 404);
        }
    }

    public function datatable(ModuleServices $moduleServices, $attributeId) {
        $currentUser = Auth::user();
        $attribute   = Attribute::find($attributeId);
        $tableAccess = Module::ModuleUserAccessList($attribute->A_FK_Module_id, $currentUser->U_User_id, 'outside')->get();

        $datatable = Datatables::of($attribute->details())
                ->setRowId('AD_Id')
                ->make(true);

        $datatableAssoc         = $datatable->getData(true);
        $datatableAssoc["data"] = $moduleServices->appendInlineActions($datatableAssoc["data"], $tableAccess);
        return $datatableAssoc;        
    }

    public function create($attributeId) {
        $attribute      = Attribute::find($attributeId);
        $this->moduleId = $attribute->A_FK_Module_id;

        $attributeDetail             = new AttributeDetail();
        $attributeDetail->AD_FK_Code = $attribute->A_Code;

        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'create';
        $viewData['formData'] = $attributeDetail;

        return view('administration.attribute.module', $viewData);
    }

    public function store(AttributeDetailRequest $request, $attributeId) {

        try {
            $attribute      = Attribute::find($attributeId);
            $this->moduleId = $attribute->A_FK_Module_id;

            $attributeDetail             = new AttributeDetail();
            $attributeDetail->AD_FK_Code = $attribute->A_Code;

            $this->requestToModel($attributeDetail, $request);
            $attributeDetail->save();
            return $attributeDetail;
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function edit($attributeId, $attributeDetailCode) {

        $attribute      = Attribute::find($attributeId);
        $this->moduleId = $attribute->A_FK_Module_id;

        $attributeDetail = AttributeDetail::findComposite([
                    "AD_FK_Code" => $attributeId,
                    "AD_Code"    => $attributeDetailCode
        ]);

        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'edit';
        $viewData['formData'] = $attributeDetail;

//        $formData = $this->initializeFormData($attribute, $attributeDetail);

        return view('administration.attribute.module', $viewData);
//        return $viewData['formData'];
    }

    public function update(AttributeDetailRequest $request, $attributeId, $attributeDetailCode) {

        try {
            $attributeDetail = AttributeDetail::findComposite([
                        "AD_FK_Code" => $attributeId,
                        "AD_Code"    => $attributeDetailCode
            ]);

            $this->requestToModel($attributeDetail, $request);
            $attributeDetail->save();
            return $attributeDetail;
        } catch (Exception $e) {
            Log::error($e->getFile() . ": line: " . $e->getLine() . " Error: " . $e->getMessage());
            return response($e->getMessage(), 500);
        }
    }

    /*     * ************************************************************************* */

    //  <editor-fold defaultstate="collapsed" desc="Utilities">

    private function requestToModel(&$model, $request) {
        $model->AD_Code = $request->input('AD_Code');
        $model->AD_Desc = $request->input('AD_Desc');

        return $model;
    }

    //  </editor-fold>
}
