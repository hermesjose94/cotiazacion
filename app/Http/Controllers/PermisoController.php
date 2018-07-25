<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\Menu;
use App\permiso;
class PermisoController extends Controller
{

    public function index()
    {

        $usuarios = User::where('fk_b001_t001_rol', 1)->get();
        $tipos = Rol::all();
        $menus = Menu::OrderBy('lo_enabled','desc')->OrderBy('nu_parent','asc')->OrderBy('nu_order','asc')->get();

        return view('menus.permisos')
        ->with('padres',$menus)
        ->with("usuarios",$usuarios)
        ->with("tipos",$tipos);
    }


    public function menus(Request $request,$id,$tipo)
    {
      if ($request->ajax()) {
          $m = Menu::menu($id,$tipo);
          return response()->json($m);
      }
    }

    public function store(Request $request)
    {
        if ($request->activar) {
          $permisos = permiso::where('fk_t001_t003_userId', $request->user)->get();
        }
        else {
          $permisos = permiso::where('fk_b001_t003_rolId', $request->rol)->get();
        }
        $menus =$request->menus;
        for ($i = 0; $i < sizeof($permisos) ; $i++) {
          $borrar = true;
          for ($j = 0; $j < sizeof($menus); $j++) {
            if ($permisos[$i]->fk_t002_t003_menuId == $menus[$j]) {
              $borrar = false;
            }
          }
          if ($borrar) {
            $permisos[$i]->delete();
          }
        }

        for ($i = 0; $i < sizeof($menus) ; $i++) {
          $agregar = true;
          for ($j = 0; $j < sizeof($permisos); $j++) {
            if ($menus[$i] == $permisos[$j]->fk_t002_t003_menuId) {
              $agregar = false;
            }
          }
          if ($agregar) {
            $permiso = new permiso();
            if ($request->activar) {
              $permiso->fk_t001_t003_userId =$request->user;
            }
            else {
              $permiso->fk_b001_t003_rolId =$request->rol;
            }
            $permiso->fk_t002_t003_menuId = $menus[$i];
            $permiso->save();
          }
        }
        return redirect()->route('home');
    }
}
