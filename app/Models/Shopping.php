<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'course_id',

        'name',
        'last_name',
        'mothers_last_name',
        'address',

        'document',
        'telephone',
        'celular',

        'address',
        'urbanizacion',
        'country',
        'provincia',
        'city',
        'distrito',

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


     public function cursoDetail(){
        return $this->hasMany(Course::class);
            //->withPivot('course_id', 'fullname');
    }
}
