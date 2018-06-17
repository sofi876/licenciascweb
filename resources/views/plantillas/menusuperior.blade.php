
    <div class="navbar-custom navbar-left">
    <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">
            <li>
                <a href="{{route('welcome')}}">
                    <span><i class="ti-home"></i></span><span> Inicio </span> </a>
            </li>

             <li class="has-submenu">
                <a href="#"> <span><i class="ti-files"></i></span><span> Licencias </span> </a>
                <ul class="submenu">
                    <li><a href="{{route('crearlicencia')}}">Ingresar</a></li>
                    <li><a href="#">Consultar</a></li>
                </ul>
            </li>

        </ul>

        <!-- End navigation menu  -->

    </div>

</div>
    <!-- Top nav Right menu -->
    <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">


        <li class="dropdown top-menu-item-xs">
            <a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="{{url('images/iconos/user.png')}}" alt="user-img" class="img-circle"> </a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="ti-settings m-r-10"></i>Cambiar Password</a></li>
                <li class="divider"></li>
               <!-- <li><a href="{ {route('logout')}}"><i class="ti-power-off m-r-10"></i>Cerrar Sesión</a></li>  -->

               <li> <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Cerrar Sesión') }}
                </a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       {{ csrf_field() }}
                   </form></li>

            </ul>
        </li>
    </ul>
