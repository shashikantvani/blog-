<?php

if(Auth::user()->user_role==1){
 $menus = DB::table('menu')->where('status',1)->get();
}else{
   $menus = DB::table('menu')->join('menu_permission','menu.id','menu_permission.menu_id')->where('menu_permission.role_id',Auth::user()->user_role)->where('menu_permission.status',1)->where('menu.status',1)->get();
}

?>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Shashi Demo</h2>
      <ul class="nav nav-pills nav-stacked">

        @foreach($menus as $menu)
        <li><a href="{{ url('/') }}{{ $menu->url}}">{{$menu->name}}</a></li>
        @endforeach
             @guest
                            <li>
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
    
      </ul>
      <br>
    </div>
    <br>