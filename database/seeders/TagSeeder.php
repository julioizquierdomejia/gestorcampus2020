<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tag = new Tag();
        $tag->name = 'Doctores';
        $tag->description = 'Doctores';
        $tag->color = "#6284FF";
        $tag->status = 1;
        $tag->save();
    }
}
