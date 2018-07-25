<?php
    namespace App\Http\ViewComposers;

    use Illuminate\View\View;
    use App\Repositories\UserRepository;
    use App\Menu;
    use App\Permiso;
    use Illuminate\Support\Facades\Auth;

    class MenuComposer
    {
      public function compose(View $view)
      {
        $user = Auth::user();
        $menus = Menu::menus();
        $permisos = new permiso();

        $rpermisos = $permisos->getRol($user->fk_b001_t001_rol);

        $upermisos = $permisos->getUser($user->co_usuario);

        $view->with('menus',$menus)
             ->with('upermisos',$upermisos)
             ->with('rpermisos',$rpermisos);
      }
    }
