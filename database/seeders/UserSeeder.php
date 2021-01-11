<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //colocamos en variables roles para poder relacionarlos
        $role_superadmin = Role::where('name', 'superadmin')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        $user = new User();
        $user->document = '06813928';
        $user->email = 'julio.izquierdo.mejia@gmail.com';
        $user->password = bcrypt('.Campus460..');
        $user->cod_nivel = 1
        $user->status = 1;

        $user->save();

        //vamos a relacionar roles con usuarios
        $user->roles()->attach($role_superadmin);

    }
}
