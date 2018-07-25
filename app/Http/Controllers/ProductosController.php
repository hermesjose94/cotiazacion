<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Producto;

class ProductosController extends Controller
{
  public function vista(){
      $user = Auth::user();
      $productos = $user->empresa->productos;
      return view('cargar')->with('productos', $productos);
  }

  public function store(Request $request){
      $this->validate($request, [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
      $user = Auth::user();
      $file = $request->file('image');
      $name = 'foto_' . time() . '.' . $file->getClientOriginalExtension();
      $path = public_path() . '/catalogo/';
      $file->move($path,$name);
      $producto = new Producto();
      $producto->ra_foto                       = $name;
      $producto->nb_nombre                     = $request->name;
      $producto->nu_precio                     = $request->precio;
      $producto->nu_descuento                  = $request->des;
      $producto->nu_cantidad                   = $request->desCant;
      $producto->nu_descuentoGrupo             = $request->desGp;
      $producto->nu_cantidadGrupo              = $request->desGpCant;
      $producto->fk_empresas_productos_empresa = $user->empresa->pk_empresa;
      $producto->save();
      return redirect()->route('cargarProductos');
  }

  public function destroy($id){
    $producto = Producto::find($id);
    $path = public_path() . '/catalogo/'. $producto->ra_foto;
    unlink($path);
    $producto->delete();
    return redirect()->route('cargarProductos');
  }

}
