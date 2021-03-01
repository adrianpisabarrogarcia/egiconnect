@extends('layout.layout-menus')


@section('content')

    <div id="layoutSidenav_content">

        <nav>
            <div class="mt-2 nav nav-tabs" id="nav-tab" role="tablist">
                <button class="ml-2 nav-link  @if((session()->get('errores')=="") && (session()->get('errorPass')=="") && (session()->get('perfilOK')=="") && (session()->get('passOK')=="")) active @endif" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="info" aria-selected="true"><div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>Información</button>
                <button class="nav-link  @if((session()->get('errores')!="") || (session()->get('perfilOK')!=""))active @endif" id="nav-edit-tab" data-bs-toggle="tab" data-bs-target="#nav-edit" type="button" role="tab" aria-controls="nav-files" aria-selected="false"><div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>Modificar</button>
                <button class="nav-link @if((session()->get('errorPass')!="") || (session()->get('pass')!="")) active @endif" id="nav-pass-tab" data-bs-toggle="tab" data-bs-target="#nav-pass" type="button" role="tab" aria-controls="nav-tareas" aria-selected="false"><div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>Cambiar Contraseña</button>
            </div>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade @if((session()->get('errores')=="") && (session()->get('errorPass')=="") && (session()->get('perfilOK')=="") && (session()->get('passOK')=="")) show active @endif" id="nav-info" role="tabpanel" aria-labelledby="nav-info">

                <div class="mt-4 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                    <div class="form-group row">
                        <label for="userMostrar" class="col-4"> Usuario:</label>
                        <div class="col-8">
                            <input type="text" class="form-control text-muted" id="userMostrar" value="{{$usuario->usuario}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nombreMostrar" class="col-4"> Nombre:</label>
                        <div class="col-8">
                            <input type="text" class="form-control text-muted" id="nombreMostrar" value="{{$usuario->nombre}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellidosMostrar" class="col-4"> Apellidos:</label>
                        <div class="col-8">
                            <input type="text" class="form-control text-muted" id="apellidosMostrar" value="{{$usuario->apellidos}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emailMostrar" class="col-4"> Dirección de correo:</label>
                        <div class="col-8">
                            <input type="text" class="form-control text-muted" id="emailMostrar" value="{{$usuario->email}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade  @if((session()->get('errores')!="") || (session()->get('perfilOK')!="")) show active @endif" id="nav-edit" role="tabpanel" aria-labelledby="profile-tab">
                <form class="user" method="POST" id="formulario" action="{{route('actualizarPerfil')}}">
                    @csrf
                    <div class="mt-4 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                        <div class="form-group row">
                            <label for="nombre" class="col-4"> Usuario:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-dark"  pattern="^([a-z]+[0-9]{0,2}){5,12}$"
                                       id="usuario" name="usuario" value="{{$usuario->usuario}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nombreMostrar" class="col-4"> Nombre:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-dark" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"
                                       id="nombre" name="nombre" value="{{$usuario->nombre}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellidos" class="col-4"> Apellidos:</label>
                            <div class="col-8">
                                <input type="text" class="form-control " pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                                       id="apellidos" name="apellidos" value="{{$usuario->apellidos}}" required>
                            </div>
                        </div>
                        <div class="mb-4 form-group row">
                            <label for="email" class="col-4"> Dirección de correo:</label>
                            <div class="col-8">
                                <input type="text" class="form-control text-dark" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
                                       id="email" name="email" value="{{$usuario->email}}" required>
                            </div>
                        </div>

                        <div id="errorTypescript">

                        </div>

                        @if((session()->get('errores')!=""))
                            <div class='alert alert-danger text-center' role='alert'>{!! session()->get('errores')  !!}</div>
                        @endif

                        @if((session()->get('perfilOK')!=""))
                            <div class='ml-3 mr-3 alert alert-success text-center' role='alert'>{!! session()->get('perfilOK')  !!}</div>
                        @endif

                        <div class="form-group text-center d-flex justify-content-center">
                            <div class="form-group mt-1 mb-0"><input type="submit"
                                                                     class="btn btn-primary btn-block"
                                                                     onclick="actualizar()"
                                                                     value="Actualizar"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade  @if((session()->get('errorPass')!="") || (session()->get('passOK')!="")) show active @endif" id="nav-pass" role="tabpanel" aria-labelledby="pass-tab">
                <div class="mt-4 col-md-7 offset-md-3">
                    <h3 class="text-center">Cambio de Contraseña</h3>
                    <br>
                    <form class="user" method="POST" id="formulario2" action="{{route('cambiarContrasena')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="contraseña" class="col-6">Contraseña actual:</label>
                            <div class="col-6">
                                <input type="password" pattern="[A-Za-z0-9!?-_]{8,12}" id="currentPass" name="currentPass" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contraseña" class="col-6">Nueva contraseña:</label>
                            <div class="col-6">
                                <input type="password" pattern="[A-Za-z0-9!?-_]{8,12}" id="pass" name="pass" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-4 form-group row">
                            <label for="recontraseña" class="col-6">Repite la contraseña:</label>
                            <div class="col-6">
                                <input type="password" pattern="[A-Za-z0-9!?-_]{8,12}" id="pass2" name="pass2" class="form-control" required>
                            </div>
                        </div>

                        <div id="erroresTypescript">

                        </div>
                        @if((session()->get('errorPass')!=""))
                            <div class='alert alert-danger text-center' role='alert'>{!! session()->get('errorPass')  !!}</div>
                        @endif

                        @if((session()->get('passOK')!=""))
                            <div class='ml-3 mr-3 alert alert-success text-center' role='alert'>{!! session()->get('passOK')  !!}</div>
                        @endif

                        <div class="form-group text-center d-flex justify-content-center">
                            <div class="form-group mt-1 mb-0"><input type="submit"
                                                                     class="btn btn-primary btn-block"
                                                                     onclick="actualizarPass()"
                                                                     value="Cambiar contraseña"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @endsection
        @section('scripts')
            <script src="js/perfil.js"></script>
@endsection
