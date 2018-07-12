<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleModalidad extends Model
{
    protected $table = 'detalle_modalidades';
    public $timestamps = false;
    protected $primaryKey = 'id_detalle';
    protected $fillable = [
        'id_detalle', 'cod_licencia', 'cod_modalidad'
    ];
}
