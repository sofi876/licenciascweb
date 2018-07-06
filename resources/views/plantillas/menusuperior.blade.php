
<!-- LOGO -->
<div class="topbar-left">
    <!-- <div class=""> -->

        <img src="{{url('images/logo_alcaldia2.png')}}" width="90" height="70" alt="logo"  />


    <!-- </div> -->
</div>
<ul class="navbar-custom navbar-left">
    <li id="navigation">
        <!-- Navigation Menu-->
         <ul class="navigation-menu">
            <li>
                <a href="{{ route('welcome')}}">
                    <span><i class="ti-home"></i></span><span> Inicio </span> </a>
            </li>

            <li class="has-submenu">
                <a href="#"> <span><i class="ti-files"></i></span><span> Licencias </span> </a>
                <ul class="submenu">
                    @if((Auth::User()->tipo) == "1" || (Auth::User()->tipo) == "2")
                    <li><a href="{{route('crearlicencia')}}">Ingresar</a></li>
                    @endif
                    <li><a href="{{route('consultarLicencias')}}">Consultar</a></li>
                    <li><a href="{{route('consultarLicenciasFiltro')}}">Consultar por filtro</a></li>
                </ul>
            </li>

             @if((Auth::User()->tipo) == "1" )
             <li class="has-submenu">
                 <a href="#"> <span><i class="ti-files"></i></span><span> Usuarios </span> </a>
                 <ul class="submenu">
                     <li><a href="{{route('crearUsuario')}}">Crear</a></li>
                     <li><a href="{{route('consultarUsuarios')}}">Consultar</a></li>
                 </ul>
             </li>
                 @endif
             @if((Auth::User()->tipo) == "1" )
                 <li class="has-submenu">
                     <a href="#"> <span><i class="ti-files"></i></span><span> Denuncias </span> </a>
                     <ul class="submenu">
                         <li><a href="{{route('consultarDenunciasFiltro')}}">Consultar</a></li>
                     </ul>
                 </li>
             @endif
        </ul>

    </li>
</ul>

    <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
        <li class="dropdown top-menu-item-xs">
            <a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true">
                <font color="white">{{Auth::User()->name}}</font> <img src="{{url('images/iconos/user.png')}}" alt="user-img" class="img-circle"> </a>
            <ul class="dropdown-menu">
                <li><a href="{{route('mostrarcambiarpassword')}}"><i class="ti-settings m-r-10"></i>Cambiar Password</a></li>
                <li class="divider"></li>

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
