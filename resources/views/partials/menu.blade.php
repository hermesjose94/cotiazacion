@php
  use App\Menu;
@endphp
@if ($upermisos || $rpermisos)
  @if ($item['submenu'] == [])
      @if (Menu::permiso($upermisos,$item['pk_menu']) || Menu::permiso($rpermisos,$item['pk_menu']))
        <li>
          <a href="{{route($item['nb_slug'])}}">
            <i class="{{$item['nb_icon']}}"></i> <span>{{ $item['nb_name'] }}</span>
          </a>
        </li>
      @endif
  @else
    @if (Menu::permiso($upermisos,$item['pk_menu']) || Menu::permiso($rpermisos,$item['pk_menu']))
      <li class="treeview">
        <a href="#">
          <i class="{{$item['nb_icon']}}"></i>
          <span>{{ $item['nb_name'] }}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @foreach ($item['submenu'] as $submenu)
              @if ($submenu['submenu'] == [])
                  @if (Menu::permiso($upermisos,$submenu['pk_menu']) || Menu::permiso($rpermisos,$submenu['pk_menu']))
                    <li>
                      <a href="{{route($submenu['nb_slug'])}}">
                        <i class="fa fa-circle-o"></i> {{ $submenu['nb_name'] }}
                      </a>
                    </li>
                  @endif
              @else
                  @include('partials.menu', [ 'item' => $submenu ])
              @endif
          @endforeach
        </ul>
      </li>
    @endif
  @endif
@endif
