<!DOCTYPE html>
<html lang="es">
<head>
    <!-- head -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>EgiConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="/css/styles.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/portal.css">

    <!-- contenido -->
    <link rel="stylesheet" href="/css/style.css">
    @yield('head')
</head>
<body class="sb-nav-fixed over">
<nav class="sb-topnav navbar navbar-expand bg-primary">
    <button class="btn btn-link btn-sm d-lg-none ml-2 boton-menu" id="sidebarToggle" href="#"><i
            class="fas fa-bars"></i></button>
    <a class="d-none d-sm-block navbar-brand" href="{{ route('index') }}"><img id="logo-principal" src="/img/logo-horizontal.png"></a>
    <!-- Navbar Dark-Mode-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <!--
        <li class="dark-mode nav-item dropdown mr-2">
            <label class="mb-0" for="darkSwitch"><i style="color: rgba(255,255,255,0.5);"
                                                    class="fas fa-fw fa-sun mr-2"></i></label>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="darkSwitch"/>
                <label class="custom-control-label" for="darkSwitch"><i style="color: rgba(255,255,255,0.5);"
                                                                        class="fas fa-fw fa-moon"></i></label>
            </div>
        </li>
        -->
        <li class="nav-item dropdown ml-3">
            <a class="nav-link dropdown-toggle text-white" id="userDropdown" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                    class="fas fa-user"></i>&nbsp;&nbsp;{{session()->get('nombre')}} <span class="ml-1"
                                                                                           style="color: rgba(255,255,255,0.5)">({{session()->get('usuario')}})</span>&nbsp;&nbsp;</a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('perfil')}}">Ajustes</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route("logOut")}}">Cerrar Sesión</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <a class="d-block ml-2 mt-2 w-75 d-sm-none navbar-brand" href="{{ route('index') }}"><img id="logo-principal" src="/img/logo-horizontal.png"></a>
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Principal</div>
                    <a class="nav-link" href="{{route('index')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        Inicio
                    </a>
                    <div class="sb-sidenav-menu-heading">Proyectos</div>
                    <?php $proyectos = session()->get('proyectos'); ?>
                    @foreach($proyectos as $datosProyectos)
                        <a class="nav-link" href="/proyecto/{{$datosProyectos[0]->id}}">
                            @if($datosProyectos[0]->idcreador==$idusu = Session::get('id'))
                                <div class="sb-nav-link-icon"><i class="fas fa-crown"></i></div>
                            @else
                                <div class="sb-nav-link-icon"><i class="fas fa-hashtag"></i></div>
                            @endif
                            {{ $datosProyectos[0]->nombre }}
                        </a>
                    @endforeach

                </div>
            </div>
        </nav>
    </div>


@yield('content')
<!-- footer -->
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; EgiConnect 2021</div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                             class="bi bi-github text-primary" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                        </svg>
                        &nbsp;
                        <a href="https://github.com/adrianpisabarrogarcia/egiconnect" target="_blank"
                           class="text-primary">GitHub</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG"
        crossorigin="anonymous"></script>

<script src="/js/scripts.js"></script>
@yield('scripts')

</body>
</html>
