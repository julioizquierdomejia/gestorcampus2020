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
