<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserMoodle;

class UserMoodleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new UserMoodle();
        $user->user_id = 1;
        $user->user = 'campusvirtual@aspefam.org.pe';
        $user->password = bcrypt('.Campus460..');
        $user->user_moodle_id = 2;
        
        $user->document = '06813928';
        
        $user->name = 'ASPEFAM';
        $user->last_name = 'CAMPUS';
        $user->mothers_last_name = 'VIRTUAL';
        $user->cod_nivel = 1;

        $user->sexo = '1';
        $user->avatar = 'avatar_man.png';

        $user->address = '';
        $user->urbanizacion = '';
        $user->distrito = '';
        $user->provincia = 'LIMA';
        $user->city = 'LIMA';
        $user->country = 'PERU';

        $user->save();
    }
}
