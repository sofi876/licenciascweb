<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadosDenuncia extends Model
{
    protected $table = 'estado_denuncia';
    public $timestamps = false;
    protected $primaryKey = 'cod_estado_denuncia';
    protected $fillable = [
        'cod_estado_denuncia', 'des_estado_denuncia'
    ];
}
