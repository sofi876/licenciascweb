<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /* Tipo -> 1:Administrador | 2:Funcionario | 3:Consultas | 4:Denuncias */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'tipo', 'notificar_licencia', 'activo', 'notificar_denuncia'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
