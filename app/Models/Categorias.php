<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categorias';

    public $primaryKey = 'id_categoria';

    public $timestamps = true;
    /*const CREATED_AT = 'fecha_alta';
    const UPDATED_AT = 'fecha_modificacion';
    const DELETED_AT = 'fecha_borrado';*/
    protected $fillable = [
        'nombre',
         'descripcion',
    ];
}
