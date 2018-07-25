<?php

namespace App\Http\Controllers;
use App\Rol;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $type_users = Rol::orderBy('nb_name', 'ASC')->get();
        $users = User::search($request->name)->orderBy('nb_nombre', 'ASC')->paginate(15);
        return view('usuarios.users')->with('type_users', $type_users)->with('users', $users);
    }

    public function store(Request $request){
      $this->validate($request, [
        'Nombre'      =>  'required|min:3|max:50|string',
        'Apellido'    =>  'required|min:3|max:50|string',
        'Email'       =>  'required|min:3|max:50|email|unique:t001_usuario,nb_email',
        'Password'    =>  'required|min:6|string',
        'Telefono'    =>  'required|min:10|numeric',
        'Usuario'      =>  'required|min:3|max:50|string',
        'TipoUsuario' =>  'required'
      ]);
      $user = new User();
      $user->nb_nombre = $request->Nombre;
      $user->nb_email = $request->Email;
      $user->password = bcrypt($request->Password);
      $user->fk_b001_t001_rol = $request->TipoUsuario;
      $user->nb_username = $request->Usuario;
      $user->nb_apellido = $request->Apellido;
      $user->nb_telefono = $request->Telefono;
    	$user->save();
      return redirect()->route('users.index');
    }

    public function update(Request $request, $id)
    {

      $user = User::find($id);
      $user->nb_nombre = $request->Nombre;
      if ($request->nb_email != $user->email) {
        $user->nb_email = $request->Email;
      }

      $user->nb_nombre = $request->Nombre;
      $user->password = bcrypt($request->Password);
      $user->fk_b001_t001_rol = $request->TipoUsuario;
      $user->nb_username = $request->Usuario;
      $user->nb_apellido = $request->Apellido;
      $user->nb_telefono = $request->Telefono;
    	$user->save();
      return redirect()->route('users.index');
    }

    public function destroy($id)
    {
      $user = User::find($id);
      $user->delete();
      return redirect()->route('users.index');
    }
}
