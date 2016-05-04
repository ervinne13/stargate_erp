<?php

namespace App\Console\Commands;

use App\Models\Module\Module;
use App\Models\Module\UserAccess;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SGMakeModule extends Command {

    protected $defaultAccessMap = [
        "view" => [
            "UA_AccessName"    => "View",
            "UA_Icon"          => "glyphicon-search",
            "UA_Outside"       => 1,
            "UA_Header"        => null,
            "UA_Inline"        => 1,
            "UA_Get"           => 1,
            "UA_TriggerInside" => null,
            "UA_GetInside"     => null,
        ],
        "add"  => [
            "UA_AccessName"    => "Add",
            "UA_Icon"          => "glyphicon-plus",
            "UA_Outside"       => 1,
            "UA_Header"        => 1,
            "UA_Inline"        => null,
            "UA_Get"           => null,
            "UA_TriggerInside" => null,
            "UA_GetInside"     => null,
        ],
        "edit" => [
            "UA_AccessName"    => "Edit",
            "UA_Icon"          => "glyphicon-edit",
            "UA_Outside"       => 1,
            "UA_Header"        => null,
            "UA_Inline"        => 1,
            "UA_Get"           => 1,
            "UA_TriggerInside" => null,
            "UA_GetInside"     => null,
        ]
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sgmake:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a level 3 module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        $description = $this->ask('Module description');
        $trigger     = $this->ask('Module trigger');
        $parentId    = $this->ask('Module parent id');

        $access = $this->choice('Access List', ['Full', 'Except Delete'], false);

        $steps = $access == 'Full' ? 5 : 4;

        $bar = $this->output->createProgressBar($steps);

        if ($this->confirm("Create module {$description}?")) {

            DB::beginTransaction();

            try {
                $module = $this->saveModule($description, $trigger, $parentId, $bar);
                $this->saveAccess($module, $access, $bar);

                DB::commit();
            } catch (Exception $e) {
                Log::error($e);
                DB::rollback();
                $this->error($e->getMessage());
            }
        }
    }

    private function saveModule($description, $trigger, $parentId, $bar) {
        $module                 = new Module();
        $module->M_Description  = $description;
        $module->M_Parent       = $parentId;
        $module->M_Trigger      = $trigger;
        $module->M_Level        = 3;
        $module->M_Active       = 1;
        $module->M_WithApproval = 1;
        $module->save();

        $bar->advance();

        return $module;
    }

    private function saveAccess($module, $access, $bar) {

        //  save default access
        foreach ($this->defaultAccessMap AS $trigger => $map) {
            $userAccess                   = new UserAccess();
            $userAccess->UA_FK_Module_id  = $module->M_Module_id;
            $userAccess->UA_AccessName    = $map["UA_AccessName"];
            $userAccess->UA_Icon          = $map["UA_Icon"];
            $userAccess->UA_Trigger       = $module->M_Trigger . "/{$trigger}";
            $userAccess->UA_Inside        = null;
            $userAccess->UA_Outside       = $map["UA_Outside"];
            $userAccess->UA_Header        = $map["UA_Header"];
            $userAccess->UA_Inline        = $map["UA_Inline"];
            $userAccess->UA_Get           = $map["UA_Get"];
            $userAccess->UA_TriggerInside = $map["UA_TriggerInside"];
            $userAccess->UA_GetInside     = $map["UA_GetInside"];

            $userAccess->save();

            $bar->advance();
        }

        if ($access == 'Full') {
            $userAccess                   = new UserAccess();
            $userAccess->UA_FK_Module_id  = $module->M_Module_id;
            $userAccess->UA_AccessName    = "Delete";
            $userAccess->UA_Icon          = "glyphicon-remove";
            $userAccess->UA_Trigger       = $module->M_Trigger . "/{$trigger}";
            $userAccess->UA_Inside        = 1;
            $userAccess->UA_Outside       = null;
            $userAccess->UA_Header        = null;
            $userAccess->UA_Inline        = 1;
            $userAccess->UA_Get           = null;
            $userAccess->UA_TriggerInside = null;
            $userAccess->UA_GetInside     = null;
            $userAccess->save();

            $bar->advance();
        }
    }

}
