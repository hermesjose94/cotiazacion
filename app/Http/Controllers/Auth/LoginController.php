<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
      $this->validate($request, [
          'username'    => 'required',
          'email'    => 'required',
          'password' => 'required',
      ]);

      if (Auth::attempt(['nb_username'=> $request->username ,'nb_email' => $request->email, 'password' => $request->password]))
       {
         //dd("datos bien");
         //return Redirect::to('home');
         return redirect()->intended('home');
       }else {
        // dd("datos mal");
        return redirect()->back()
            ->withInput()
            ->withErrors([
                'email' => 'Usuario o contraseña incorrectos.',
                'username' => 'Usuario o contraseña incorrectos.',
                'password' => 'Usuario o contraseña incorrectos.',
            ]);
       }
    }
}
