<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Log;
use App\Helpers\UserSystemInfoHelper;


class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        //
		/*
		$getip = UserSystemInfoHelper::get_ip();
		$getbrowser = UserSystemInfoHelper::get_browsers();
		$getdevice = UserSystemInfoHelper::get_device();
		$getos = UserSystemInfoHelper::get_os();
		*/

        $log = new Log();
        $log->user_id = 1;
        $log->section = 'Usuarios';
        $log->action = 'Creación';
        $log->feedback = 'self';
        $log->ip = '$getip';
        $log->device = '$getdevice';
        $log->system = '$getos';
        $log->save();

        
    }
}
