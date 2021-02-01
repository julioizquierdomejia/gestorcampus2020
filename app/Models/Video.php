<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_types_id',
        'name',
        'especialidad',
        'tema',
        'contenido',
        'fecha',
        'duracion',
        'url',
        'tags',
        'status',
    ];

    /**
     * The database connection used by the model.
     *
     * @var string
     */
     protected $connection = 'mysql';
 
     /**
     * The database table used by the model.
     *
     * @var string
     */
     //protected $table = 'courses';
}
