<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
  protected $table="cotizaciones";

  protected $primaryKey = 'pk_cotizacion';

  protected $fillable =[
                        'fa_fecha',
                      ];

  public function user(){
    return $this->belongsTo('App\User','fk_usuarios_cotizaciones_usuario');
  }

  public function producto(){
    return $this->belongsTo('App\Producto','fk_productos_cotizaciones_producto');
  }
}
