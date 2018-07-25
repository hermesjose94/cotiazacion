<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table="roles";

    protected $primaryKey = 'pk_rol';

    protected $fillable = [
        'nb_name',
        'lo_bloqueado',
    ];

    public function users(){
      return $this->hasMany('App\User','fk_roles_usuarios_co_rol','pk_rol');
    }

}
