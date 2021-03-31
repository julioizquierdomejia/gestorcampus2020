<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompetitorType;

class CompetitorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $video_type = new CompetitorType();
        $video_type->name = 'Conferencista';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new CompetitorType();
        $video_type->name = 'panelista';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new CompetitorType();
        $video_type->name = 'tutor';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new CompetitorType();
        $video_type->name = 'otros';
        $video_type->status = 1;
        $video_type->save();
    }
}
