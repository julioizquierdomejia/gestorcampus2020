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
        
        $user->document = '00000000';
        
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
        /*$user->resena = '';
        $user->lugar_trabajo = '';
        $user->universidad = '';
        $user->profesion = '';*/

        $user->save();


        $user = new UserMoodle();
        $user->user_id = 1;
        $user->user = 'jcmezagarcia@gmail.com';
        $user->password = bcrypt('12345678');
        $user->user_moodle_id = 2;
        
        $user->document = '00000001';
        
        $user->name = 'Juan Carlos';
        $user->last_name = 'Meza';
        $user->mothers_last_name = '';
        $user->cod_nivel = 1;

        $user->sexo = '1';
        $user->avatar = 'avatar_man.png';

        $user->address = '';
        $user->urbanizacion = '';
        $user->distrito = '';
        $user->provincia = 'LIMA';
        $user->city = 'LIMA';
        $user->country = 'PERU';
        /*$user->resena = '';
        $user->lugar_trabajo = '';
        $user->universidad = '';
        $user->profesion = '';*/

        $user->save();


        $user = new UserMoodle();
        $user->user_id = 1;
        $user->user = 'josecarlosquispetapia@gmail.com';
        $user->password = bcrypt('12345678');
        $user->user_moodle_id = 2;
        
        $user->document = '00000002';
        
        $user->name = 'Jose Carlos';
        $user->last_name = 'Quispe';
        $user->mothers_last_name = 'Tapia';
        $user->cod_nivel = 1;

        $user->sexo = '1';
        $user->avatar = 'avatar_man.png';

        $user->address = '';
        $user->urbanizacion = '';
        $user->distrito = '';
        $user->provincia = 'LIMA';
        $user->city = 'LIMA';
        $user->country = 'PERU';
        /*$user->resena = '';
        $user->lugar_trabajo = '';
        $user->universidad = '';
        $user->profesion = '';*/

        $user->save();


        $user = new UserMoodle();
        $user->user_id = 1;
        $user->user = 'creaula@gmail.com';
        $user->password = bcrypt('12345678');
        $user->user_moodle_id = 2;
        
        $user->document = '00000003';
        
        $user->name = 'Cesar';
        $user->last_name = 'Pastor';
        $user->mothers_last_name = 'Sotomayor';
        $user->cod_nivel = 1;

        $user->sexo = '1';
        $user->avatar = 'avatar_man.png';

        $user->address = '';
        $user->urbanizacion = '';
        $user->distrito = '';
        $user->provincia = 'LIMA';
        $user->city = 'LIMA';
        $user->country = 'PERU';
        /*$user->resena = '';
        $user->lugar_trabajo = '';
        $user->universidad = '';
        $user->profesion = '';*/

        $user->save();
    }
}
