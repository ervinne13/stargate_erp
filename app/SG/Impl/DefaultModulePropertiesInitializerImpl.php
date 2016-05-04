<?php

namespace App\SG\Impl;

use App\Models\Module\Module;
use App\SG\ModulePropertiesInitializer;

/**
 * Description of DefaultModuleValueInitializerImpl
 *
 * @author Ervinne Sodusta
 */
class DefaultModulePropertiesInitializerImpl implements ModulePropertiesInitializer {

    public function getProperties($moduleId) {

        $currentModule       = Module::find($moduleId);
        //  find the topmost module and use it as the currently selected module header
        $currentModuleHeader = $currentModule;
        while ($currentModuleHeader["M_Header"] != 1 || $currentModuleHeader["M_Parent"] != 0) {
            $currentModuleHeader = $currentModuleHeader->moduleParent()->first();
        }

        return [
            "id"                    => NULL,
            "includeModuleMetaData" => true,
            "currentModule"         => $currentModule,
            "currentModuleHeader"   => $currentModuleHeader,
            "moduleHeaders"         => Module::headers()->active()->get(),
        ];
    }

}
