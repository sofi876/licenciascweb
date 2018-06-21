<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenciaConstruccion extends Model
{
    //
    protected $table = 'licencia_construccion';
    public $timestamps = false;
    protected $primaryKey = 'cod_licencia';
    protected $fillable = [
        'cod_licencia', 'num_licencia', 'fecha_radicacion', 'fecha_expedicion', 'fecha_ejecutoria', 'fecha_vence','cod_estado','antecedentes'
    ];
}
