<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;



    protected $fillable = [
        'course_moodle_id',
        'course_group_id',
        'instructor',
        'price',
        'introduccion',
        'description',
        'Informacion_adicional',
        'novedades',
        'categoria',
        'shortname',
        'fullname',
        'status',
        'type',
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
     protected $table = 'courses';


}
