<?php

namespace App\Http\Controllers;

use App\SG\ModulePropertiesInitializer;
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

    protected $moduleIdMap = [];
    protected $moduleId;
    private $defaultViewData;

    public function __construct(ModulePropertiesInitializer $moduleProperties) {

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
        return $this->defaultViewData;
    }

}
