<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CotizarController extends Controller
{
  public function vista(){
      $user = Auth::user();
      $productos = $user->empresa->productos;
      return view('cotizar')->with('productos', $productos);
  }
}
