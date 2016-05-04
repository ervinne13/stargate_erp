<?php

namespace App\SG\Impl\Administration;

use App\Models\Administration\Reason;
use App\Models\Administration\ReasonModule;
use App\SG\Administration\ReasonService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Description of DefaultReasonServiceImpl
 *
 * @author ervinne
 */
class DefaultReasonServiceImpl implements ReasonService {

    public function saveReason(Reason $reason) {

        DB::beginTransaction();

        DB::listen(function($query) {
            Log::info('DefaultReasonServiceImpl: ' . $query->sql);
        });

        try {
            $moduleIdList = $reason->R_Module_id_list;
            unset($reason->R_Module_id_list);
            $reason->save();

            if ($moduleIdList) {
                foreach ($moduleIdList AS $moduleId) {
                    $reasonModule                  = new ReasonModule();
                    $reasonModule->RM_FK_Reason_id = $reason->R_Id;
                    $reasonModule->RM_FK_Module_id = $moduleId;
                    $reasonModule->save();
                }
            }

            DB::commit();
            return $reason;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

}
