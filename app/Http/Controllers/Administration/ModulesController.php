<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Module\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Facades\Datatables;

class ModulesController extends Controller {

    protected $moduleId = 15;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('administration.modules.index', $this->getDefaultViewData());
    }

    public function datatable() {
        $datatable = Datatables::of(Module::AccessAndFunctions())
                ->setRowId('M_Module_id')
                ->make(true);

        return $datatable;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        //
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
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
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

}
