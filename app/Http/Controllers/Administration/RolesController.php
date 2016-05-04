<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administration\RoleRequest;
use App\Models\Module\Module;
use App\Models\User\Position;
use App\SG\ModuleServices;
use App\SG\StaticDataLookup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;
use function response;
use function view;

class RolesController extends Controller {

    protected $moduleId = 14;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $currentUser  = Auth::user();
        $headerAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'header')->get();
        $viewData     = array_merge($this->getDefaultViewData(), [
            'headerAccess' => $headerAccess
        ]);

        return view('administration.roles.index', $viewData);
    }

    public function datatable(ModuleServices $moduleServices) {

        $currentUser = Auth::user();
        $tableAccess = Module::ModuleUserAccessList($this->moduleId, $currentUser->U_User_id, 'outside')->get();

        $datatable = Datatables::of(Position::query())
                ->setRowId('P_Position_id')
                ->make(true);

        $datatableAssoc         = $datatable->getData(true);
        $datatableAssoc["data"] = $moduleServices->appendInlineActions($datatableAssoc["data"], $tableAccess);
        return response()->json($datatableAssoc);
    }

    public function type($type) {
        return Position::Type($type)->select(["P_Position", "P_Position_id"])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(StaticDataLookup $staticDataLookup) {
        $role = new Position();

        $viewData                       = $this->getDefaultViewData();
        $viewData['mode']               = 'create';
        $viewData['types']              = $staticDataLookup->get("role_group");
        $viewData['rolesOfCurrentType'] = [];
        $viewData['formData']           = $role;

        return view('administration.roles.module', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RoleRequest $request) {
        try {
            $role = new Position();
            $this->requestToRole($role, $request);
            $role->save();
            return $role;
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, StaticDataLookup $staticDataLookup) {
        $role = Position::find($id);

        $viewData                       = $this->getDefaultViewData();
        $viewData['mode']               = 'edit';
        $viewData['types']              = $staticDataLookup->get("role_group");
        $viewData['rolesOfCurrentType'] = $this->type($role->P_Type);
        $viewData['formData']           = $role;

        return view('administration.roles.module', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(RoleRequest $request, $id) {

        try {
            $role = Position::find($id);
            $this->requestToRole($role, $request);
            $role->save();
            return $role;
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    private function requestToRole(&$role, RoleRequest $request) {
        $input            = $request->input();
        $role->P_Position = $input["P_Position"];
        $role->P_Type     = $input["P_Type"];

        if (array_key_exists("P_Parent", $input)) {
            $role->P_Parent = $input["P_Parent"];
        } else {
            $role->P_Parent = null;
        }
    }

}
