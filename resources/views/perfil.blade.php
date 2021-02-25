@extends('layout.layout-menus')


@section('content')

<div id="layoutSidenav_content">

    <nav>
        <div class="mt-2 nav nav-tabs" id="nav-tab" role="tablist">
            <button class="ml-2 nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="info" aria-selected="true"><div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>Información</button>
            <button class="nav-link" id="nav-edit-tab" data-bs-toggle="tab" data-bs-target="#nav-edit" type="button" role="tab" aria-controls="nav-files" aria-selected="false"><div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>Modificar</button>
            <button class="nav-link" id="nav-pass-tab" data-bs-toggle="tab" data-bs-target="#nav-pass" type="button" role="tab" aria-controls="nav-tareas" aria-selected="false"><div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>Cambiar Contraseña</button>
        </div>
    </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info">

                    <div class="mt-4 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                        <div class="form-group row">
                            <label for="dniMostrar" class="col-4"> Usuario:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-muted" id="dniMostrar" value="" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombreMostrar" class="col-4"> Nombre:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-muted" id="nombreMostrar" value="" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellidosMostrar" class="col-4"> Apellidos:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-muted" id="apellidosMostrar" value="" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emailMostrar" class="col-4"> Dirección de correo:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-muted" id="emailMostrar" value="" disabled>
                            </div>
                        </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-edit" role="tabpanel" aria-labelledby="profile-tab">
                <form class="user" method="POST" id="formulario" action="">
                    @csrf
                        <div class="mt-4 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                        <div class="form-group row">
                            <label for="nombre" class="col-4"> Usuario:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-dark" id="usuario" name="usuario" value="">
                            </div>
                        </div>

                            <div class="form-group row">
                                <label for="nombreMostrar" class="col-4"> Nombre:</label>
                                <div class="col-8">
                                    <input type="text" class="form-control text-muted" id="nombreMostrar" value="">
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="apellido" class="col-4"> Apellidos:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-dark " id="apellido" name="apellido" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-4"> Dirección de correo:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-dark" id="email" name="email" value="">
                            </div>
                        </div>
                        <div id="mensajeError">
                            <span class="mt-3" id="mensajeErrorSpan">{!! session()->get('error') !!}</span>
                        </div>

                        <div class="form-group text-center">
                            <a class="btn btn-primary" id="botonActualizarPerfil">Actualizar</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-pass" role="tabpanel" aria-labelledby="pass-tab">
                <div class="mt-4 col-md-7 offset-md-3">
                    <h3 class="text-center">Cambio de Clave</h3>
                    <br>
                    <form class="user" method="POST" id="formulario2" action="">
                        @csrf
                        <div class="form-group row">
                            <label for="contraseña" class="col-6">Nueva contraseña:</label>
                            <div class="col-6">
                                <input type="password" id="pass" name="pass" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recontraseña" class="col-6">Repite la contraseña:</label>
                            <div class="col-6">
                                <input type="password" id="pass2" name="pass2" class="form-control">
                            </div>
                        </div>
                        <div id="mensajeError2">
                            <span class="mt-3" id="mensajeErrorSpan2">{!! session()->get('error') !!}</span>
                        </div>

                        <div class="form-group text-center">
                            <a class="btn btn-primary" id="botonActualizarContrasena">Cambiar contraseña</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
