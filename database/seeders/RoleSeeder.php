<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $role = new Role();
        $role->name = 'manager';
        $role->description = 'Administrador del sistema';
        $role->save();

        $role = new Role();
        $role->name = 'coursecreator';
        $role->description = 'Creador de cursos';
        $role->save();

        $role = new Role();
        $role->name = 'editingteacher';
        $role->description = 'Docente Editor';
        $role->save();

        $role = new Role();
        $role->name = 'teacher';
        $role->description = 'Docente';
        $role->save();

        $role = new Role();
        $role->name = 'student';
        $role->description = 'Estudiante';
        $role->save();

        $role = new Role();
        $role->name = 'guest';
        $role->description = 'Usuaio Invitado';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'Usuario';
        $role->save();

        $role = new Role();
        $role->name = 'frontpage';
        $role->description = 'Front Page';
        $role->save();

        $role = new Role();
        $role->name = 'superadmin';
        $role->description = 'Super administrador del sistema - config';
        $role->save();

    }
}
