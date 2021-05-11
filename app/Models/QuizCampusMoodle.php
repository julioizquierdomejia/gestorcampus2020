<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizCampusMoodle extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'name',
        'intro',
        'grade',
    ];

    /** 
    * The name of the "created at" column. 
    * 
    * @var string 
    */ 
    const CREATED_AT = 'timecreated'; 

    /** 
    * The name of the "updated at" column. 
    * 
    * @var string 
    */ 
    const UPDATED_AT = 'timemodified'; 

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
     protected $table = 'quiz';
}
