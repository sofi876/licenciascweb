<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadosLicencia extends Model
{
    //
    protected $table = 'estado_licencia';
    public $timestamps = false;
    protected $primaryKey = 'cod_estado';
    protected $fillable = [
        'cod_estado', 'des_estado_licencia'
    ];
}
