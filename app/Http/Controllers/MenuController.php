<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
  public function index()
  {
      $menus = Menu::OrderBy('lo_enabled','desc')->OrderBy('nu_parent','asc')->OrderBy('nu_order','asc')->get();
      return view('menus.menu')->with('padres',$menus);
  }

  public function iconos()
  {
    return view('menus.iconos');
  }

  public function store(Request $request)
  {
      $this->validate($request,[
        'Nombre'    =>  'required|min:4|max:150|string',
        'Icono'     =>  'required|min:8|max:50|string',
        'Ruta'      =>  'required|min:1|max:150|string',
        'Orden'     =>  'required|min:0|numeric',
        'Padre'     =>  'required'
      ]);
      $menu = new Menu();
      $menu->nb_name   = $request->Nombre;
      $menu->nb_icon   = $request->Icono;
      $menu->nb_slug   = $request->Ruta;
      $menu->nu_order  = $request->Orden;
      $menu->nu_parent = $request->Padre;
      if ($request->activar) {
        $menu->lo_enabled = "1";
      }
      else {
        $menu->lo_enabled = "0";
      }
      $menu->save();
      return redirect()->route('menus.index');
  }

  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'Nombre'    =>  'required|min:4|max:150|string',
      'Icono'     =>  'required|min:8|max:50|string',
      'Ruta'      =>  'required|min:1|max:150|string',
      'Orden'     =>  'required|min:0|numeric',
      'Padre'     =>  'required'
    ]);
    //dd($request);
      $menu = Menu::find($id);
      $menu->nb_name   = $request->Nombre;
      $menu->nb_icon   = $request->Icono;
      $menu->nb_slug   = $request->Ruta;
      $menu->nu_order  = $request->Orden;
      $menu->nu_parent = $request->Padre;
      if ($request->activar) {
        $menu->lo_enabled = "1";
      }
      else {
        $menu->lo_enabled = "0";
      }
      $menu->save();
      return redirect()->route('menus.index');
  }

  public function destroy($id)
  {
      $menu = Menu::find($id);
      $menu->delete();
      return redirect()->route('menus.index');
  }
}
