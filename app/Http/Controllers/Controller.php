<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateActiveRequest;
use App\SG\ModulePropertiesInitializer;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    protected $moduleProperties;
    protected $lazyLoadsDefaultViewData = false;
    protected $moduleIdMap              = [];
    protected $moduleId;
    protected $activeField;
    private $defaultViewData;
    //  For Active/Inactive functions    
    private $currentModuleModel         = NULL;
    private $moduleIdField              = NULL;
    private $moduleActiveStatusField    = NULL;

    public function __construct(ModulePropertiesInitializer $moduleProperties) {
        if (!$this->lazyLoadsDefaultViewData) {
            $this->initializeDefaultViewData($moduleProperties);
        } else {
            $this->moduleProperties = $moduleProperties;
        }
    }

    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Controller Data Functions">

    private function initializeDefaultViewData(ModulePropertiesInitializer $moduleProperties) {
        $this->initializeRepeatingModuleId();

        if ($this->moduleId) {
            $this->defaultViewData = $moduleProperties->getProperties($this->moduleId);
        }

        if (Auth::check()) {
            $this->defaultViewData["currentUser"] = Auth::user();
        }
    }

    private function initializeRepeatingModuleId() {
        if (count($this->moduleIdMap) > 0) {

            //  find out the correct parent module
            $splittedUri              = explode('/', Request::path());
            $foundParentModuleTrigger = $splittedUri[0];

            foreach ($this->moduleIdMap AS $parentModuleTrigger => $moduleId) {
                if (strtolower($foundParentModuleTrigger) == strtolower($parentModuleTrigger)) {
                    $this->moduleId = $moduleId;
                    break;
                }
            }
        }
    }

    protected function getDefaultViewData() {

        if ($this->lazyLoadsDefaultViewData) {
            $this->initializeDefaultViewData($this->moduleProperties);
        }

        return $this->defaultViewData;
    }

    protected function getCurrentModule() {
        $defaultViewData = $this->getDefaultViewData();
        return $defaultViewData["currentModule"];
    }

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Module Function Initializer">
    protected function enableActivateFunctions($currentModuleModel, $moduleIdField, $moduleActiveStatusField) {
        $this->currentModuleModel      = $currentModuleModel;
        $this->moduleIdField           = $moduleIdField;
        $this->moduleActiveStatusField = $moduleActiveStatusField;
    }

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Module Functions">

    public function activate(UpdateActiveRequest $request) {

        if (!$this->currentModuleModel) {
            return response("Updating active status on this module is not enabled or you do not have the rights to execute this function", 403);
        }

        $idList = explode(',', $request->idList);
        try {
            $this->setActiveStatus($idList, true);
            return [
                "result"  => 1,
                "message" => "OK"
            ];
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function deactivate(UpdateActiveRequest $request) {
        if (!$this->currentModuleModel) {
            return response("Updating active status on this module is not enabled or you do not have the rights to execute this function", 403);
        }

        $idList = explode(',', $request->idList);
        try {
            $this->setActiveStatus($idList, false);
            return [
                "result"  => 1,
                "message" => "OK"
            ];
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    private function setActiveStatus($idList, $active) {
        $model = new $this->currentModuleModel;

        return $model
                        ->whereIn($this->moduleIdField, $idList)
                        ->update([$this->moduleActiveStatusField => $active]);
    }

    //  </editor-fold>
}
