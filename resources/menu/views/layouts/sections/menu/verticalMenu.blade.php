<?php
$myMenu = $menuData[0]->menu;
$myMenu2 = $menuData2[0]->menu;

$role = session('role');

$roleId = session('roleId');

$roleId = json_decode($roleId);

$newMenuList = [];

$newMenuList[] = $myMenu2[0];

if($roleId->p1 == 1){
  $newMenuList[] = $myMenu2[1];
  $newMenuList[] = $myMenu2[4];
  $newMenuList[] = $myMenu2[5];
  $newMenuList[] = $myMenu2[7];
  $newMenuList[] = $myMenu2[8];
  unset($newMenuList[1]->submenu[1]);
  unset($newMenuList[1]->submenu[2]);
  unset($newMenuList[3]->submenu[1]);
  unset($newMenuList[5]->submenu[2]);
  unset($newMenuList[5]->submenu[3]);
  unset($newMenuList[5]->submenu[4]);
}

if($roleId->b1 == 1){
  $newMenuList[] = $myMenu2[9];
  $newMenuList[] = $myMenu2[10];
}

if($role == 'Admin'){
  $myMenu = $menuData[0]->menu;
}else{
  $myMenu = $newMenuList;
}
// echo '<pre>';
// print_r($newMenuList[5]->submenu[2]);
// echo '<pre>';
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  <div class="app-brand demo my-3" style="align-items: center; justify-content: center;z-index:5">
    {{-- <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo"></span>
        @include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2">{{config('variables.templateName')}}</span> --}}
      <img src="{{ asset('assets/img/logo/logo.png') }}" alt  width="170%">
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-autod-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    @foreach ($myMenu as $menu)

    {{-- adding active and open class if child is active --}}

    {{-- menu headers --}}
    @if (isset($menu->menuHeader))
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">{{ $menu->menuHeader }}</span>
    </li>

    @else

    {{-- active menu method --}}
    @php
    $activeClass = null;
    $currentRouteName = Route::currentRouteName();

    if ($currentRouteName === $menu->slug) {
    $activeClass = 'active';
    }
    elseif (isset($menu->submenu)) {
    if (gettype($menu->slug) === 'array') {
    foreach($menu->slug as $slug){
    if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
    $activeClass = 'active open';
    }
    }
    }
    else{
    if (str_contains($currentRouteName,$menu->slug) and strpos($currentRouteName,$menu->slug) === 0) {
    $activeClass = 'active open';
    }
    }

    }
    @endphp

    {{-- main menu --}}
    <li class="menu-item {{$activeClass}}">
      <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
        @isset($menu->icon)
        <i class="{{ $menu->icon }}"></i>
        @endisset
        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
      </a>

      {{-- submenu --}}
      @isset($menu->submenu)
      @include('layouts.sections.menu.submenu',['menu' => $menu->submenu])
      @endisset
    </li>
    @endif
    @endforeach
  </ul>

</aside>
