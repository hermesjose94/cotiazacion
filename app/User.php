<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table="usuarios";

    protected $primaryKey = 'pk_usuario';

    protected $fillable = [
        'nb_email',
        'nb_username',
        'ra_avatarAvatar',
        'password',
        'nb_nombre',
        'nb_apellido',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol(){
      return $this->belongsTo('App\Rol','fk_roles_usuarios_co_rol');
    }

    public function empresa(){
      return $this->belongsTo('App\Empresa','fk_empresas_usuarios_co_empresa');
    }

    public function cotizaciones(){
      return $this->hasMany('App\Cotizacion','fk_usuarios_cotizaciones_usuario','pk_usuario');
    }

    public function scopeSearch($query,$name){
      return $query->where('nb_nombre','LIKE',"%$name%");
    }

}
