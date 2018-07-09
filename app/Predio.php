<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    //
    protected $table = 'informacion_predio';
    public $timestamps = false;
    protected $primaryKey = 'cod_informacion';
    protected $fillable = [
        'cod_informacion', 'cod_licencia', 'barrio', 'viaprincipal', 'numerovia', 'numero1', 'numero2', 'complemento', 'estrato', 'matricula', 'cedula_catastral'
    ];
}
