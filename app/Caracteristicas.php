<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracteristicas extends Model
{

    //
    protected $table = 'caracteristicas_licencia';
    public $timestamps = false;
    protected $primaryKey = 'cod_caracteristica';
    protected $fillable = [
        'cod_caracteristica', 'cod_licencia', 'des_proyecto', 'cod_tipo_licencia', 'cod_modalidad', 'cod_objeto', 'cod_tipo_uso', 'num_pisos'
    ];
}
