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
        $user->user = 'julio.izquierdo.mejia@gmail.com';
        $user->password = bcrypt('M4r14Jul14123456');
        $user->name = 'JULIO JORGE';
        $user->last_name = 'IZQUIERDO';
        $user->mothers_last_name = 'MEJIA';

        $user->save();
    }
}
