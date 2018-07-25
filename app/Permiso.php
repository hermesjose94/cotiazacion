<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
  protected $table="permisos";

  protected $primaryKey = 'pk_permiso';

  public function getRol($id)
  {
      return $this->where('fk_roles_permisos_co_rol', $id)
          ->get();
  }
  public function getUser($id)
  {
      return $this->where('fk_ususarios_permisos_co_usuario', $id)
          ->get();
  }
}
