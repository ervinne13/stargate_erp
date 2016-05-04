<?php

namespace App\Http\Controllers\HRIS;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeeProfileController extends Controller {

    protected $moduleId = 295;

    public function create() {
        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'create';
        $viewData["employee"] = $this->jessy;

        //  consolidated data
        $viewData["employee"]["display_name"] = "{$viewData["employee"]["EP_First_name"]} {$viewData["employee"]["EP_Middle_name"]} {$viewData["employee"]["EP_Last_name"]} ";

        return view('hris.employee_profile.create', $viewData);
    }

    public function show($id) {
        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'view';
        $viewData["employee"] = $this->prepareConsolidatedData($this->jessy);

        return view('hris.employee_profile.view', $viewData);
    }

    public function edit($id) {
        echo $id;
        $viewData             = $this->getDefaultViewData();
        $viewData['mode']     = 'edit';
        $viewData["employee"] = $this->prepareConsolidatedData($this->jessy);

        return view('hris.employee_profile.edit', $viewData);
    }

    protected function prepareConsolidatedData($profile) {

        //  consolidated data
        $profile["display_name"] = "{$profile["EP_First_name"]} {$profile["EP_Middle_name"]} {$profile["EP_Last_name"]} ";

        return $profile;
    }

    protected $jessy = [
        "EP_Primary_image"  => "/img/sample-users/jessy_esquire.jpg",
        "EP_First_name"     => "Jessica",
        "EP_Middle_name"    => "Mendiola",
        "EP_Last_name"      => "Tawile",
        "EP_Title"          => "Model - Esquire",
        "EP_Short_location" => "Manila, Philippines",
        "EP_Education"      => "B.S. in Mass Communication in Far Eastern University",
        "EP_Notes"          => "Jessy Mendiola was one of the 18 new talents launched by ABS-CBN under Star Magic Batch 15.",
        "tags"              => [
            ["T_Label_style" => "label-warning", "T_Keyword" => "Model"],
            ["T_Label_style" => "label-warning", "T_Keyword" => "Actress"],
            ["T_Label_style" => "label-danger", "T_Keyword" => "FHM"],
            ["T_Label_style" => "label-info", "T_Keyword" => "Esquire"],
            ["T_Label_style" => "label-success", "T_Keyword" => "Star Magic"],
            ["T_Label_style" => "label-primary", "T_Keyword" => "Filipino-British"],
            ["T_Label_style" => "label-primary", "T_Keyword" => "Filipino-Lebanese"]
        ],
        "skills"            => [
            ["EPS_Label_style" => "label-warning", "EPS_Skill" => "Modelling"],
            ["EPS_Label_style" => "label-success", "EPS_Skill" => "Acting"],
            ["EPS_Label_style" => "label-primary", "EPS_Skill" => "Hosting"]
        ],
    ];

}
