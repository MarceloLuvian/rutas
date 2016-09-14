<?php

namespace RUTAS;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tipoUsuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

      public $timestamps =false;
    protected $hidden = [
        'password', 'remember_token',
    ];
}
