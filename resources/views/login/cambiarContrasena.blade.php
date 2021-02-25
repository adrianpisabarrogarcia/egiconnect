@extends('layout.layout-principal')
@section('content')
    <link rel="stylesheet" href="/css/login.css">
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Recupera tu contraseña</h3></div>
                            <div class="card-body">
                                <form class="user" method="POST" id="formulario" action="{{route("recuperarContrasena")}}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Correo electrónico</label>
                                        <input class="form-control py-4" id="email" name="email" type="email" aria-describedby="emailHelp" placeholder="Escribe aquí tu correo electrónico" required/>
                                        <input type="hidden" id="pass" name="pass">
                                    </div>
                                    <div class="form-group mt-4 mb-0"><input type="submit" class="btn btn-primary btn-block" id="botonRecuperarContrasena" value="Recuperar contraseña"></div>
                                </form>
                                <div class="mt-3" id="mensajeError">
                                    <span  id="mensajeErrorSpan">{!! session()->get('error') !!}</span>
                                </div>

                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="{{route('login.home')}}">¿Ya tienes una cuenta y te acuerdas de la contraseña? Acceder</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection


    @section('scripts')
        <script src="/js/recuperarContrasena.js"></script>
@endsection
