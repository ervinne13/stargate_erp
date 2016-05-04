<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\SG\Impl\Administration;

use App\Models\Administration\CompanyAccess;
use App\Models\User\User;
use App\SG\Administration\UserService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Description of DefaultUserServiceImpl
 *
 * @author ervinne
 */
class DefaultUserServiceImpl implements UserService {

    public function save(User $user) {

        DB::beginTransaction();

        try {
            $locationIdList  = $user->U_Location_id_list;
            $defaultLocation = $user->U_Default_location;
            unset($user->U_Location_id_list);
            unset($user->U_Default_location);

            $user->save();

            //  reset default location
//            CompanyAccess::where("CA_FK_User_id", $user->U_User_id)->update(["CA_DefaultLocation" => '0']);
            CompanyAccess::where("CA_FK_User_id", $user->U_User_id)->delete();

            foreach ($locationIdList AS $locationId) {
                $companyAccess = new CompanyAccess();

                $defaultLocation = $defaultLocation == $locationId ? 1 : 0;

                $companyAccess->CA_FK_User_id      = $user->U_User_id;
                $companyAccess->CA_FK_Location_id  = $locationId;
                $companyAccess->CA_DefaultLocation = $defaultLocation;

                $companyAccess->save();
            }

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

}
