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
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header d-flex justify-content-center"><img id="logo-login"
                                                                                        src="/img/logo-login.png"></div>
                            <div class="card-body">
                                <form method="POST" action="{{route('login.enter')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Usuario</label>
                                        <input class="form-control py-4" id="inputEmailAddress" name="user" type="text"
                                               placeholder="Escribe aquí tu correo electrónico o usuario" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Contraseña</label>
                                        <input class="form-control py-4" id="inputPassword" name="password"
                                               type="password"
                                               placeholder="Escribe aquí tu contraseña" required/>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                            <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                        </div>

                                    </div>
                                    -->
                                    @if(isset($error))
                                        <div class='alert alert-danger text-center' role='alert'>{{ $error }}</div>
                                    @endif
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="{{route('solicitarContrasena')}}">¿Has olvidado la
                                            contraseña?</a>
                                        <input type="submit" class="btn btn-primary" value="Entrar">
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="{{route('registro')}}">¿No estás registrado?
                                        ¡Regístrate!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

