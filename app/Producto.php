<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table="productos";

  protected $primaryKey = 'pk_producto';

  protected $fillable =[
                        'ra_foto',
                        'nb_nombre',
                        'nu_precio',
                        'nu_descuento',
                        'nu_cantidad',
                        'nu_descuentoGrupo',
                        'nu_cantidadGrupo',
                      ];

  public function empresa(){
    return $this->belongsTo('App\Empresa','fk_empresas_productos_empresa');
  }

  public function cotizaciones(){
    return $this->hasMany('App\Cotizacion','fk_productos_cotizaciones_producto','pk_usuario');
  }
}
