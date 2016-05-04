<?php

namespace App\Console\Commands;

use App\Models\Module\Module;
use App\Models\User\UserProfile;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SGAddAccess extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sgadd:access';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $userId   = $this->ask('User id');
        $password = $this->secret('Password');

        if (Auth::attempt(['U_User_id' => $userId, 'password' => $password])) {

            $moduleId = $this->ask('Module id');

            $module         = Module::find($moduleId);
            $userAccessList = $module->userAccess;

            $this->info($module->M_Description . " - Added Access To:");

            DB::beginTransaction();
            try {
                foreach ($userAccessList AS $userAccess) {
                    $userProfile                  = new UserProfile();
                    $userProfile->UP_FK_Module_id = $module->M_Module_id;
                    $userProfile->UP_FK_User_id   = $userId;
                    $userProfile->UP_FK_Access_id = $userAccess->UA_Access_id;
                    $userProfile->save();
                    $this->info($userAccess->UA_AccessName);
                }
                DB::commit();
            } catch (Exception $e) {
                Log::error($e);
                DB::rollback();
                $this->error($e->getMessage());
            }
        } else {
            $this->error("Authentication failed");
        }
    }

}
