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
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Crea tu cuenta</h3>
                            </div>
                            <div class="card-body">
                                <form action="https://google.es" method="POST">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFirstName">Nombre</label>
                                                <input class="form-control py-4" id="inputFirstName" type="text" name="nombre"
                                                       placeholder="Escribe tu nombre"
                                                       pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"
                                                       required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputLastName">Apellidos</label>
                                                <input class="form-control py-4" id="inputLastName" type="text" name="apellidos"
                                                       placeholder="Escribe tus apellidos"
                                                       pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Usuario</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="text" name="usuario"
                                               placeholder="Escribe tu nickname o apodo. Mínimo 5 carácteres, máximo 12."
                                               pattern="^([a-z]+[0-9]{0,2}){5,12}$" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Correo electrónico</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="email" name="email"
                                               aria-describedby="emailHelp"
                                               placeholder="Escribe tu correo electrónico"
                                               pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
                                               required/>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Contraseña</label>
                                                <input class="form-control py-4" id="inputPassword" type="password"
                                                       placeholder="Mínimo 8 carácteres, máximo 12" name="password"
                                                       pattern="[A-Za-z0-9!?-_]{8,12}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputConfirmPassword">Repite la
                                                    contraseña</label>
                                                <input class="form-control py-4" id="inputConfirmPassword"
                                                       type="password" placeholder="Vuelve a repetir la contraseña"
                                                       pattern="[A-Za-z0-9!?-_]{8,12}" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="erroresTypescript">

                                    </div>
                                    <div class="form-group mt-4 mb-0"><input type="submit" class="btn btn-primary btn-block"
                                                                             onclick="registro()" value="Crear cuenta"></div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="{{route('login.home')}}">¿Ya tienes cuenta? Accede</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @endsection

    @section('scripts')
        <script src="/js/registro.js"></script>
@endsection
