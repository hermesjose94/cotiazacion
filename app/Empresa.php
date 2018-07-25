<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
  protected $table="empresas";

  protected $primaryKey = 'pk_empresa';

  protected $fillable =[
                        'nb_nombre',
                        'nb_rif',
                        'nb_direccion',
                      ];
                      
  public function users(){
    return $this->hasMany('App\User','fk_empresas_usuarios_co_empresa','pk_empresa');
  }

  public function productos(){
    return $this->hasMany('App\Producto','fk_empresas_productos_empresa','pk_empresa');
  }
}
