<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denuncias extends Model
{
    //
    protected $table = 'denuncias';
    public $timestamps = false;
    protected $primaryKey = 'cod_denuncia';
    protected $fillable = [
        'cod_denuncia', 'cod_licencia', 'imagen', 'georeferencia', 'des_denuncia', 'cod_estado_denuncia', 'nueva', 'fecha', 'observacion'
    ];
}
