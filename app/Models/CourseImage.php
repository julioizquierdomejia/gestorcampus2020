<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_img',
        'course_id',
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
