<label for="show-menu" class="show-menu">Show Menu</label>
<input type="checkbox" id="show-menu" role="button">
<ul id="menu">
   <!--  <li><img src="{ {url('images/logo_alcaldia2.png')}}" width="90" height="70" alt="logo"  /></li>  -->
    <li><a href="{{ route('welcome')}}">Inicio</a></li>
    <li>
        <a href="#">Licencias ￬</a>
        <ul class="hidden">
            <li><a href="{{route('crearlicencia')}}">Ingresar</a></li>
            <li><a href="#">Consultar</a></li>
        </ul>
    </li>
    <li>
        <a href="#">Portfolio ￬</a>
        <ul class="hidden">
            <li><a href="#">Photography</a></li>
            <li><a href="#">Web & User Interface Design</a></li>
            <li><a href="#">Illustration</a></li>
        </ul>
    </li>
    <li><a href="#">News</a></li>
    <li><a href="#">Contact</a></li>
</ul>