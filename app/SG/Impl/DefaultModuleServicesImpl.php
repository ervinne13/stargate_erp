<?php

namespace App\SG\Impl;

use App\Module;
use App\SG\ModuleServices;

/**
 * Description of ModuleServicesProvider
 *
 * @author Ervinne Sodusta
 */
class DefaultModuleServicesImpl implements ModuleServices {

    public $actionColumnName = "actions";

    /**
     * Will append the actions/access to each entry in the given $modelList and 
     * return the result.
     * For table access, see scopeUserAccessList under Module model. Specify the
     * name of the status field so rows' access/buttons may be restricted based 
     * on the status.
     * @param type $modelList
     *  The array of objects to append
     * @param type $accessList
     *  The access of the user on the module. See scopeUserAccessList under Module model.
     * @param type $statusFieldName
     *  (Optional) The column name of the status field. If this is specified, rows's
     *  buttons/access will be restricted based on its status.
     *  Ex. rows with status = "Open" are the only rows allowed to have an "Edit" action.
     * @return type
     */
    public function appendInlineActions($modelList, $accessList, $statusFieldName = NULL) {
        if ($accessList) {
            for ($i = 0; $i < count($modelList); $i ++) {
                $modelList[$i][$this->actionColumnName] = $this->getRowAccessList($modelList[$i], $accessList, $statusFieldName);
            }
        }

        return $modelList;
    }

    /**
     * Converts the list of modules into a tree based on the M_Parent field of
     * each modules. Sub modules will be stored in a M_Children field.
     * @param type $moduleList
     * @return type
     */
    public function listToTree($moduleList) {

        $topParentModules = [];
        $parentModules    = [];
        foreach ($moduleList AS $module) {
            $parentModules[$module["M_Parent"]][] = $module;
            if ($module["M_Header"] == 1 && $module["M_Parent"] == 0) {
                $topParentModules[] = $module;
            }
        }
        $moduleTree = $this->createTree($parentModules, $topParentModules);

        return $moduleTree;
    }

    private function getRowAccessList($row, $accessList, $statusFieldName) {
        $appendedAccessList = array();

        if ($statusFieldName && strtolower($row[$statusFieldName]) == "open") {
            foreach ($accessList AS $access) {
                if (strtolower($access["UA_AccessName"]) != "edit") {
                    array_push($appendedAccessList, $this->getGenericAccess($access));
                }
            }
        } else {
            foreach ($accessList AS $access) {
                array_push($appendedAccessList, $this->getGenericAccess($access));
            }
        }

        return $appendedAccessList;
    }

    private function getGenericAccess($access) {
        return [
            "access_name" => $access["UA_AccessName"],
            "link"        => $access["UA_Trigger"],
            "is_get"      => $access["UA_Get"] == 1,
            "icon"        => $access["UA_Icon"]
        ];
    }

    private function createTree(&$list, $parentList) {
        $tree = array();
        foreach ($parentList AS $parent) {
            if (isset($list[$parent['M_Module_id']])) {
                $parent['M_Children'] = $this->createTree($list, $list[$parent['M_Module_id']]);
            }
            $tree[] = $parent;
        }
        return $tree;
    }

}
