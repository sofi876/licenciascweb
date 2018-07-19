<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionDenuncia extends Model
{
    //
    protected $table = 'notificaciones_denuncia';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'cod_denuncia', 'cod_usuario', 'fecha', 'enviado'
    ];
}
