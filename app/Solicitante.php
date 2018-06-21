<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    //
    protected $table = 'datos_solicitante';
    public $timestamps = false;
    protected $primaryKey = 'cod_solicitante';
    protected $fillable = [
        'cod_solicitante', 'cod_licencia', 'documento', 'nombres', 'apellidos', 'cod_tipo_persona'
    ];
}
