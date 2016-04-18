<?php

namespace App\SG;

/**
 *
 * @author Ervinne Sodusta
 */
interface ModuleServices {

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
    public function appendInlineActions($modelList, $accessList, $statusFieldName = NULL);

    public function listToTree($moduleList);    
}
