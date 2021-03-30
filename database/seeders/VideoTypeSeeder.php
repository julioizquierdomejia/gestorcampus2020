<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video_type;

class VideoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $video_type = new Video_type();
        $video_type->name = 'Conferencia';
        $video_type->description = 'Conferencia';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new Video_type();
        $video_type->name = 'Seminario';
        $video_type->description = 'Seminario';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new Video_type();
        $video_type->name = 'Panel';
        $video_type->description = 'Panel';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new Video_type();
        $video_type->name = 'Conversatorio';
        $video_type->description = 'Conversatorio';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new Video_type();
        $video_type->name = 'Foro';
        $video_type->description = 'Foro';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new Video_type();
        $video_type->name = 'Sesión de aprendizaje';
        $video_type->description = 'Sesión de aprendizaje';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new Video_type();
        $video_type->name = 'Mesa Redonda';
        $video_type->description = 'Mesa Redonda';
        $video_type->status = 1;
        $video_type->save();

        $video_type = new Video_type();
        $video_type->name = 'Discución de casos Clínicos';
        $video_type->description = 'Discución de casos Clínicos';
        $video_type->status = 1;
        $video_type->save();
    }
}
