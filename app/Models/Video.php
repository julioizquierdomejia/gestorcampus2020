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
        'resumen',
        'contenido',
        'fecha',
        'duracion',
        'url',
        'tags',
        'lugar',
        'tipo_licencia',
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

    protected $dates = [
        'created_at',
        'updated_at',
        'fecha'
    ];
}
