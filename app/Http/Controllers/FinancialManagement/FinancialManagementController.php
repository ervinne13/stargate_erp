<?php

namespace App\Http\Controllers\FinancialManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinancialManagementController extends Controller {

    protected $moduleId = 3;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
//        DB::enableQueryLog();
//        dd(DB::getQueryLog());
        
        return view('financial-management/index', $this->getDefaultViewData());
//        $viewData = $this->getDefaultViewData();        
//        
//        return $viewData["currentModule"]->moduleChildren;
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
