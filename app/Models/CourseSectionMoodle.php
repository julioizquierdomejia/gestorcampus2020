<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSectionMoodle extends Model
{
    use HasFactory;

    /**
     * The database connection used by the model.
     *
     * @var string
     */
     protected $connection = 'mysql_moodle';
 
     /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'course_sections';
}
