<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class UserMoodle extends Model
{
    use HasFactory;


    /**
     * The database connection used by the model.
     *
     * @var string
     */

    protected $fillable = [
        'name',
        'user_moodle_id',
        'last_name',
        'mothers_last_name',
        'sexo',
        'avatar',
        'address',
        'urbanizacion',
        'distrito',
        'city',
        'provincia',
        'country',
        'telephone',
        'celular'
    ];


     protected $connection = 'mysql';
 
     /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'usermoodles';

     public function roles(){
        return $this->belongsToMany(Role::class);

     }
}
