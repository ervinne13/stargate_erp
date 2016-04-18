<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Module;
use App\SG\ModuleServices;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\Datatables\Facades\Datatables;

class UsersController extends Controller {

    protected $moduleId = 13;

    public function index() {
        $contentType = Request::header('Content-Type');

        if (strtolower($contentType) == "application/json") {
            try {
                $users = User::all();
            } catch (Exception $e) {
                return new JsonResponse($e->getMessage(), 500);
            }

            return $users;
        } else {

            $currentUser  = Auth::user();
            $headerAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'header')->get();
            $viewData     = array_merge($this->getDefaultViewData(), [
                'headerAccess' => ["access" => $headerAccess]
            ]);

            return view('administration.users.index', $viewData);
        }
    }

    public function datatable(ModuleServices $moduleServices) {

        $currentUser = Auth::user();
        $tableAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'outside')->get();
        $users       = User::datatable()->get();

        $datatable = Datatables::of($moduleServices->appendInlineActions($users, $tableAccess))
                ->setRowId('U_Username')
                ->make(true);

//        DB::enableQueryLog();
//        dd(DB::getQueryLog());

        return $datatable;
    }

    public function settings($id, ModuleServices $moduleServices) {

        $contentType = Request::header('Content-Type');

        $user       = User::encryptedId($id);
        $modules    = Module::UserAccessList($user->U_User_id)->get();
        $moduleTree = $moduleServices->listToTree($modules);

        if (strtolower($contentType) == "application/json") {
            return $moduleTree;
        } else {

            $viewData = array_merge($this->getDefaultViewData(), [
                'id'   => $id,
                'user' => $user
            ]);

            return view('administration.users.settings', $viewData);
        }
    }

    public function edit($id) {
        echo $id;
    }

    public function show($id, ModuleServices $moduleServices) {
        $modules = Module::active()->get();
        return $moduleServices->listToTree($modules);
//        return User($id)->get();
    }

}
