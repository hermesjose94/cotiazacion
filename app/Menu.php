<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permiso;

class Menu extends Model
{
  protected $table="menus";

  protected $primaryKey = 'pk_menu';

  protected $fillable =[
                        'nb_name',
                        'nb_icon',
                        'nb_slug',
                        'nu_parent',
                        'nu_order',
                        'lo_enabled'
                      ];

  public static function menu($id,$tipo)
  {
      $collection = collect();
      $permisos = new Permiso();
      if ($tipo == 1) {
        $p = $permisos->getUser($id);
      }
      else {
        $p = $permisos->getRol($id);
      }
      $m = Menu::all();
      $tam = sizeof($m);
      for ($i = 0; $i < $tam; $i++) {
        $borrar = true;
          for ($j=0; $j < sizeof($p) ; $j++) {
            if ($p[$j]->fk_menus_permisos_co_menu == $m[$i]->pk_permiso) {
              $collection->push($m[$i]);
            }
          }
      }
      return $collection;
  }

  public static function permiso($permisos,$id)
  {
//dd($permisos);
    for ($i=0; $i <sizeof($permisos) ; $i++) {
    //  echo $permisos[$i]->fk_menus_permisos_co_menu;
      if ($permisos[$i]->fk_menus_permisos_co_menu == $id) {
        return true;
      }
    }
    return false;
  }

  public function getChildren($data, $line)
   {
       $children = [];
       foreach ($data as $line1) {
           if ($line['pk_menu'] == $line1['nu_parent']) {
               $children = array_merge($children, [ array_merge($line1, ['submenu' => $this->getChildren($data, $line1) ]) ]);
           }
       }
       return $children;
   }
   public static function padre($data, $line)
    {
        $children = "";
        foreach ($data as $line1) {
            if ($line['nu_parent'] == $line1['pk_menu']) {
                $children =$line1['nb_name'];
            }
        }
        return $children;
    }

   public static function countChildren($data, $line)
    {
        $children = 0;
        foreach ($data as $line1) {
            if ($line['pk_menu'] == $line1['nu_parent']) {
                $children ++;
            }
        }
        return $children;
    }

   public function optionsMenu()
   {
       return $this->where('lo_enabled', 1)
           ->orderby('nu_parent')
           ->orderby('nu_order')
           ->orderby('nb_name')
           ->get()
           ->toArray();
   }
   public static function menus()
   {
       $menus = new Menu();
       $data = $menus->optionsMenu();
       $menuAll = [];
       foreach ($data as $line) {
           $item = [ array_merge($line, ['submenu' => $menus->getChildren($data, $line) ]) ];
           $menuAll = array_merge($menuAll, $item);
       }
       return $menus->menuAll = $menuAll;
   }
}
