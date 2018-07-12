<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLicencia extends Model
{
    protected $table = 'tipo_licencia';
    public $timestamps = false;
    protected $primaryKey = 'cod_tipo_licencia';
    protected $fillable = [
        'cod_tipo_licencia', 'des_licencia', 'varios_predios', 'varias_modalidades'
    ];
}
