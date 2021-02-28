@extends('layout.layout-menus')
@section('head')
    <link href="/css/chat.css" rel="stylesheet"/>
    <link href="/css/proyecto.css" rel="stylesheet"/>
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="layoutSidenav_content">
        <nav>
            <div class="nav-menu">
                <div class="mt-2 nav nav-tabs nav-proyecto" id="nav-tab" role="tablist">
                    <button class="ml-2 nav-link  @if((session()->get('errores')=="") && (session()->get('green')=="")) active @endif" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                        Chat
                    </button>
                    <button class="nav-link" id="nav-files-tab" data-bs-toggle="tab" data-bs-target="#nav-files"
                            type="button" role="tab" aria-controls="nav-files" aria-selected="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                        Archivos
                    </button>
                    <button class="nav-link" id="nav-tareas-tab" data-bs-toggle="tab" data-bs-target="#nav-tareas"
                            type="button" role="tab" aria-controls="nav-tareas" aria-selected="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                        Tareas
                    </button>
                    <button class="nav-link" id="nav-usuarios-tab" data-bs-toggle="tab" data-bs-target="#nav-users"
                            type="button" role="tab" aria-controls="nav-users" aria-selected="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                        Usuarios
                    </button>
                    @if(session()->get('id')==$proyecto->idcreador)
                    <button class="nav-link  @if((session()->get('errores')!="") || (session()->get('green')!="")) active @endif" id="nav-edit-tab" data-bs-toggle="tab" data-bs-target="#nav-edit" type="button"
                            role="tab" aria-controls="nav-edit" aria-selected="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                        Modificar
                    </button>
                    @endif
                </div>
                <button style="border: none" type="button" data-bs-toggle="modal" data-bs-target="#info" data-bs-whatever="@getbootstrap">
                    <div class="mas-info sb-nav-link-icon mr-3 mt-1"><i class="fas text-primary fa-info-circle h4 mb-0"></i></div>
                </button>
                <div style="width: 100vw" class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="proyecto" method="POST" id="formularioSalirProyecto" action="{{route('salirProyecto')}}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN DEL PROYECTO</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h1 class="text-center bg-primary text-white rounded" >{{$proyecto->codigo}}</h1>
                                        <div class="mb-3">
                                            <label for="nombreProyecto" class="col-form-label">Nombre del proyecto:</label>
                                            <input type="text" class="form-control text-dark" id="nombreProyecto" name="codigoProyecto" value="{{$proyecto->nombre}}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion" class="col-form-label">Descripción:</label>
                                            <textarea disabled style="resize: none" rows="5" class="form-control text-dark" id="descripcion" name="descripcion" >{{$proyecto->descripcion}}</textarea>
                                        </div>
                                    <input type="hidden" name="idproy" id="idproyectoSalir" value="{{$proyecto->id}}">
                                </div>
                                <div class="modal-footer">
                                    @if(session()->get('id')!=$proyecto->idcreador)
                                    <button type="submit" class="btn btn-danger">Salir del proyecto</button>
                                    @endif
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </nav>


        <main>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade   @if((session()->get('errores')=="") && (session()->get('green')=="")) show active @endif" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="chat_window">

                        <ul class="messages">
                            @if(isset($mensajes))
                                @foreach($mensajes as $datosMensajes)
                                    @if($datosMensajes->idusu == session()->get('id'))
                                        <li>
                                            <div class="mensajeYo">
                                                <p class="font-weight-bold">{{ $datosMensajes->nombre }}
                                                    - {{ $datosMensajes->fecha  }}</p>
                                                <div>{{ $datosMensajes->descripcion }}</div>
                                            </div>
                                        </li>
                                    @else
                                        <li>
                                            <div class="mensajeEllos">
                                                <p class="font-weight-bold">{{ $datosMensajes->nombre }}
                                                    - {{ $datosMensajes->fecha  }}</p>
                                                <div>{{ $datosMensajes->descripcion }}</div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                        <div class="bottom_wrapper clearfix">
                            <div class="message_input_wrapper">
                                <form method="POST" action="/proyecto/chat">
                                    @csrf
                                    <input class="message_input" name="mensaje" placeholder="Escribe un nuevo mensaje"/>
                                </form>
                            </div>
                            <div class="send_message">
                                <div class="icon"></div>
                                <div class="text">Enviar</div>
                            </div>
                        </div>
                    </div>
                    <div class="message_template">
                        <li class="message">
                            <div class="text_wrapper">
                                <p> nombre - fecha </p>
                                <div class="text">texto normal</div>
                            </div>
                        </li>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-files" role="tabpanel" aria-labelledby="nav-files-tab">
                    
                </div>
                <div class="tab-pane fade" id="nav-tareas" role="tabpanel" aria-labelledby="nav-tareas-tab">...</div>
                <div class="tab-pane fade"  id="nav-users" role="tabpanel" aria-labelledby="nav-usuarios-tab">...
                </div>

                @if(session()->get('id')==$proyecto->idcreador)
                <div class="tab-pane fade  @if((session()->get('errores')!="") || (session()->get('green')!="")) show active @endif" id="nav-edit" role="tabpanel" aria-labelledby="nav-edit-tab">
                    <form class="user" method="POST" id="formulario" action="{{route('actualizarProyecto')}}">
                        @csrf
                        <div class="mt-5 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                            <div class="form-group row">
                                <label for="nombreMostrar" class="col-4"> Nombre del proyecto:</label>
                                <div class="col-8">
                                    <input type="text" class="form-control text-dark"
                                           id="nombre" name="nombre" value="{{$proyecto->nombre}}" pattern="^[a-zA-ZÀ-ÿ_.0-9\s]{3,30}$" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="col-form-label">Descripción:</label>
                                <textarea style="resize: none" rows="5" class="form-control" id="descripcion" name="descripcion" >{{$proyecto->descripcion}}</textarea>
                            </div>

                            <input type="hidden" name="idproy" id="idproy" value="{{$proyecto->id}}">
                            <input type="hidden" name="currentName" id="currentName" value="{{$proyecto->nombre}}">
                            <input type="hidden" name="currentDes" id="currentDes" value="{{$proyecto->descripcion}}">


                        </div>
                    </form>
                    <form class="user" method="POST" id="formularioCodigo" action="{{route('generarNuevoCodigo')}}">
                        @csrf
                        <div class="mt-4 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                            <div class="form-group row">
                                <label for="codigo" class="col-3 col-sm-2 offset-sm-4 offset-md-5 offset-xl-6"> Codigo:</label>
                                <div class="col-5 col-sm-4 col-md-3">
                                    <input type="text" class="form-control text-muted"
                                           id="codigo" name="codigo" value="{{$proyecto->codigo}}" disabled>
                                </div>
                                <input type="hidden" name="idproy" id="idproyecto" value="{{$proyecto->id}}">
                                <div class="col-2 col-md-1">
                                    <a class="btn btn-primary" id="botonGenerarCodigo"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </div>
                        </div>


                    </form>

                    <div class="mt-4 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                        @if((session()->get('green')!=""))
                            <div class='ml-3 mr-3 alert alert-success text-center' role='alert'>{!! session()->get('green')  !!}</div>
                        @endif
                        @if((session()->get('errores')!=""))
                            <div class='ml-3 mr-3 alert alert-success text-center' role='alert'>{!! session()->get('errores')  !!}</div>
                        @endif
                            <div id="erroresTypescriptActualizar">
                            </div>
                    </div>

                    <div class="form-group text-center d-flex justify-content-center">
                        <div class="form-group mt-1 mb-0"><input type="submit"
                                                                 class="btn btn-primary btn-block"
                                                                 onclick="actualizarProyecto()"
                                                                 value="Actualizar"></div>
                    </div>

                    <div class="form-group text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrar" data-bs-whatever="@getbootstrap">
                                Eliminar proyecto
                        </button>
                    </div>
                    <div style="width: 100vw" class="modal fade" id="borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form class="user" method="POST" id="formularioBorrar" action="{{route('borrarProyecto')}}">
                                @csrf
                                    <div class="modal-body">
                                            <input type="hidden" name="idproy" id="idproyectoBorrar" value="{{$proyecto->id}}">
                                            <p class="mt-2">¿Estás seguro de que deseas eliminar el proyecto de <b>"{{$proyecto->nombre}}"</b>? </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" id="borrarProyecto" class="btn btn-primary">Borrar proyecto</button>
                                    </div>
                            </form>
                            </div>
                        </div>
                </div>
                </div>
                @endif
            </div>
        </main>
        @endsection
        @section('scripts')
            <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
                    crossorigin="anonymous"></script>
            <script src="/js/dark-mode-switch.min.js"></script>
            <script src="/js/chat.js"></script>
            <script src="/js/proyectos.js"></script>

@endsection
