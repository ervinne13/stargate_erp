<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\UserRequest;
use App\Models\Administration\StoreProfile;
use App\Models\Module\Module;
use App\Models\User\Position;
use App\Models\User\User;
use App\SG\Administration\UserService;
use App\SG\ModulePropertiesInitializer;
use App\SG\ModuleServices;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\Datatables\Facades\Datatables;
use function response;
use function view;

class UsersController extends Controller {

    protected $moduleId = 13;

    public function __construct(ModulePropertiesInitializer $moduleProperties) {
        parent::__construct($moduleProperties);

        $this->enableActivateFunctions(User::class, DB::raw('md5("U_User_id")'), "U_Status");
    }

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

            $currentUser = Auth::user();

            $viewData                 = $this->getDefaultViewData();
            $viewData["functions"]    = Module::ModuleUserFunctionList($this->moduleId, $currentUser->U_User_id, 'outside')->get();
            $viewData["headerAccess"] = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'header')->get();

            return view('administration.users.index', $viewData);
        }
    }

    public function datatable(ModuleServices $moduleServices) {

        $currentUser = Auth::user();
        $tableAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'outside')->get();
//        $users       = User::datatable()->get();

        $datatable = Datatables::of(User::datatable())
                ->setRowId('U_Username')
                ->make(true);

//        DB::enableQueryLog();
//        dd(DB::getQueryLog());

        $datatableAssoc         = $datatable->getData(true);
        $datatableAssoc["data"] = $moduleServices->appendInlineActions($datatableAssoc["data"], $tableAccess);
        return $datatableAssoc;
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

    public function create() {
        $user = new User();

        $user->U_Location_id_list = "";

        $viewData                        = $this->getDefaultViewData();
        $viewData['mode']                = 'create';
        $viewData["selectableRoles"]     = Position::all();
        $viewData["selectableLocations"] = StoreProfile::select(["SP_StoreID", "SP_StoreName"])->get();
        $viewData['formData']            = $user;

        return view('administration.users.create', $viewData);
    }

    public function store(UserRequest $request, UserService $userService) {
        try {
            $user = new User();
            $this->requestToUser($user, $request);

            return $userService->save($user);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function edit($id) {
        $user = User::EncryptedId($id);

        $viewData                        = $this->getDefaultViewData();
        $viewData['mode']                = 'edit';
        $viewData["selectableRoles"]     = Position::all();
        $viewData["selectableLocations"] = StoreProfile::select(["SP_StoreID", "SP_StoreName"])->get();
        $viewData['formData']            = $this->initializeUser($user);

        return view('administration.users.edit', $viewData);
    }

    public function update(UserRequest $request, UserService $userService, $id) {
        try {
            $user = User::EncryptedId($id);
            unset($user->id);
            $this->requestToUser($user, $request);

            return $userService->save($user);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function destroy($id) {
        try {
            $user = User::EncryptedId($id);
            $user->delete();

            return "Deleted";
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    private function initializeUser(&$user) {

        $userLocations   = $user->locations->toArray();
        $locationIdList  = [];
        $defaultLocation = "";

        foreach ($userLocations AS $location) {
            array_push($locationIdList, $location["CA_FK_Location_id"]);
            if ($location["CA_DefaultLocation"] == 1) {
                $defaultLocation = $location["CA_FK_Location_id"];
            }
        }
        $user->U_Location_id_list = join(',', $locationIdList);
        $user->U_Default_location = $defaultLocation;

        return $user;
    }

    private function requestToUser(&$user, UserRequest $request) {

        $input                    = $request->input();
        $user->U_User_id          = $input["U_User_id"];
        $user->U_Username         = $input["U_Username"];
        $user->U_FK_Position_id   = $input["U_FK_Position_id"];
        $user->U_Location_id_list = $input["U_Location_id_list"];
        $user->U_Default_location = $input["U_Default_location"];
        $user->U_Password         = "";
        $user->U_Password2        = Hash::make($input["U_Password"]);
    }

}
