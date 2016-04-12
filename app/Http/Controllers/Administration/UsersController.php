<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\Datatables\Facades\Datatables;

class UsersController extends Controller {

    protected $moduleId = 13;

    public function datatable($testType = null) {

        $users = Datatables::of(User::datatable($this->moduleId))->setRowId('U_Username')->make(true);

        if ($testType && $testType == "performance") {

            echo "Time is measured in milliseconds";

            DB::enableQueryLog();
            dd(DB::getQueryLog());
        }

        return $users;
    }

    public function index() {
        $contentType = Request::header('Content-Type');

        try {
            if (strtolower($contentType) == "application/datatable") {
                $users = Datatables::of(User::datatable($this->moduleId))->setRowId('U_Username')->make(true);
                return $users;
            } else {
                $users = User::all();
            }
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), 500);
        }

        if (strtolower($contentType) == "application/json") {
            return $users;
        } else {
            return view('administration/users');
        }
    }

    public function show($id) {
        echo $id;
    }

}
