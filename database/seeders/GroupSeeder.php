<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $group = new Group();
        $group->name = 'Programa Tinku';
        $group->description = 'Programa Tinku';
        $group->status = 1;
        $group->save();
    }
}
