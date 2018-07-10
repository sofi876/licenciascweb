<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditoriaLicencia extends Model
{
    protected $table = 'auditoria_licencias';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'tipo', 'fecha', 'cod_usuario', 'cod_licencia'
    ];
}
