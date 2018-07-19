<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionLicencia extends Model
{
    //
    protected $table = 'notificaciones_licencia';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'cod_licencia', 'cod_usuario', 'fecha', 'enviado'
    ];
}
