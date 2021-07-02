<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoCompbt extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'cod_doc';

    protected $fillable = [
        'tipo_de_comprobante',
        'nombre_comprobante',
        'serie',
        'numero',
        'estado_doc',
    ];

    /** 
    * The name of the "created at" column. 
    * 
    * @var string 
    */ 
    //const CREATED_AT = 'timecreated'; 

    /** 
    * The name of the "updated at" column. 
    * 
    * @var string
    */ 
    //const UPDATED_AT = 'timemodified';

    /**
     * The database connection used by the model.
     *
     * @var string
     */
     protected $connection = 'mysql_moodle_sigen';
 
     /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'documento_compbt';
}
