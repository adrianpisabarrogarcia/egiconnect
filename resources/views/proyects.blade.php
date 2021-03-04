@extends('layout.layout-menus')
@section('head')
    <link href="/css/chat.css" rel="stylesheet"/>
    <link href="/css/proyecto.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css"> <!-- css de las tablas -->
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="layoutSidenav_content">
        <nav>

            <div class="nav-menu">
                <div class="mt-2 nav nav-tabs nav-proyecto" id="nav-tab" role="tablist">
                    <button
                        class="ml-2 nav-link  @if((session()->get('errores')=="") && (session()->get('green')=="") && (session()->get('usuario-borrado')=="") && (session()->get('tarea')=="") && (session()->get('file')=="") ) active @endif"
                        id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                        Chat
                    </button>
                    <button class="nav-link @if(session()->get('file')!="") active @endif" id="nav-files-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-files"
                            type="button" role="tab" aria-controls="nav-files" aria-selected="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                        Archivos
                    </button>
                    <button class="nav-link @if(session()->get('tarea')!="") active @endif" id="nav-tareas-tab"
                            data-bs-toggle="tab" data-bs-target="#nav-tareas"
                            type="button" role="tab" aria-controls="nav-tareas" aria-selected="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                        Tareas
                    </button>
                    <button class="nav-link @if(session()->get('usuario-borrado')!="") active @endif"
                            id="nav-usuarios-tab" data-bs-toggle="tab" data-bs-target="#nav-users"
                            type="button" role="tab" aria-controls="nav-users" aria-selected="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                        Usuarios
                    </button>
                    @if(session()->get('id')==$proyecto->idcreador)
                        <button
                            class="nav-link  @if((session()->get('errores')!="") || (session()->get('green')!="")) active @endif"
                            id="nav-edit-tab" data-bs-toggle="tab" data-bs-target="#nav-edit" type="button"
                            role="tab" aria-controls="nav-edit" aria-selected="false">
                            <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                            Modificar
                        </button>
                    @endif
                </div>

                <button style="border: none" type="button" data-bs-toggle="modal" data-bs-target="#info"
                        data-bs-whatever="@getbootstrap">
                    <div class="mas-info sb-nav-link-icon mr-3 mt-1"><i
                            class="fas text-primary fa-info-circle h4 mb-0"></i></div>
                </button>
                <div style="width: 100vw" class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="proyecto" method="POST" id="formularioSalirProyecto"
                                  action="{{route('salirProyecto')}}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN DEL PROYECTO</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h1 class="text-center bg-primary text-white rounded">{{$proyecto->codigo}}</h1>
                                    <div class="mb-3">
                                        <label for="nombreProyecto" class="col-form-label">Nombre del proyecto:</label>
                                        <input type="text" class="form-control text-dark" id="nombreProyecto"
                                               name="codigoProyecto" value="{{$proyecto->nombre}}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="col-form-label">Descripción:</label>
                                        <textarea disabled style="resize: none" rows="5" class="form-control text-dark"
                                                  id="descripcion"
                                                  name="descripcion">{{$proyecto->descripcion}}</textarea>
                                    </div>
                                    <input type="hidden" name="idproy" id="idproyectoSalir" value="{{$proyecto->id}}">
                                </div>
                                <div class="modal-footer">
                                    @if(session()->get('id')!=$proyecto->idcreador)
                                        <button type="submit" class="btn btn-danger">Salir del proyecto</button>
                                    @endif
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </nav>


        <main>
            <div class="tab-content" id="nav-tabContent">
                <div
                    class="tab-pane fade   @if((session()->get('errores')=="") && (session()->get('green')=="") && (session()->get('usuario-borrado')=="") && (session()->get('tarea')=="") && (session()->get('file')=="")) show active @endif"
                    id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="chat_window">

                        <ul class="messages">
                            @if(isset($mensajes))
                                @foreach($mensajes as $datosMensajes)
                                    <?php
                                    $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $datosMensajes->fecha);
                                    $fecha_actual = strtotime(date("Y-m-d", time()));
                                    $fecha_entrada = strtotime($fecha->format("Y-m-d"));
                                    ?>
                                    @if($datosMensajes->idusu == session()->get('id'))
                                        <li>
                                            <div class="mensajeYo">
                                                <p class="font-weight-bold">
                                                    Yo -
                                                    @if($fecha_actual == $fecha_entrada)
                                                        Hoy {{ $fecha->format('H:i') }}
                                                    @else
                                                        {{ $fecha->format('d-m-Y  H:i') }}
                                                    @endif
                                                </p>
                                                <div>{{ $datosMensajes->descripcion }}</div>
                                            </div>
                                        </li>
                                    @else
                                        <li>

                                            <div class="mensajeEllos">
                                                <p class="font-weight-bold"> {{ $datosMensajes->nombre }} -
                                                    @if($fecha_actual == $fecha_entrada)
                                                        Hoy {{ $fecha->format('H:i') }}
                                                    @else
                                                        {{ $fecha->format('d-m-Y  H:i') }}
                                                    @endif
                                                </p>
                                                <div>{{ $datosMensajes->descripcion }}</div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                        <div class="bottom_wrapper clearfix">
                            <form method="POST" action="/proyecto/chat" enctype="multipart/form-data" id="formularioChat">
                                @csrf
                                <div class="message_input_wrapper">

                                    <input type="text" class="message_input" name="mensaje"
                                           placeholder="Escribe un nuevo mensaje"/>

                                </div>
                                <div class="send_message">
                                    <div class="icon"></div>
                                    <div class="text">Enviar</div>
                                </div>
                            </form>
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
                <div class="tab-pane fade @if(session()->get('file')!="") show active @endif" id="nav-files" role="tabpanel"
                     aria-labelledby="nav-files-tab">
                    <form class="proyecto" method="POST" enctype="multipart/form-data" id="formularioFile"
                          action="{{route('subirArchivo')}}">

                        @csrf
                        <div class="file-upload input-group m2-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="archivo" name="archivo">
                                <label class="custom-file-label" for="archivo">Selecciona un archivo</label>
                            </div>

                            <input type="hidden" name="idproy" id="idproyFile" value="{{$proyecto->id}}">
                            <div class="input-group-append">
                                <input type="button" class="input-group-text" id="botonSubirArchivo" value="Subir">
                            </div>
                        </div>
                    </form>

                    <div id="erroresTypescriptFile">
                    </div>

                    <div class="tablatodos m-3">
                        <table class="table_of_users display compact stripe bg-primary" id="tablesFiles">
                            <thead>
                            <tr class="text-white">
                                <th>Nombre</th>
                                <th>Tamaño</th>
                                <th>Fecha</th>
                                <th>Autor</th>
                                <th><center>Descargar</center></th>
                                <th><center>Eliminar</center></th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($archivos)
                                @foreach ($archivos as $archivo)
                                    <tr class="text-dark">
                                        <td><b>{{ $archivo->nombre}}</b>
                                            <button style="border: none; width: 30px; background: none" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#modal{{$archivo->id}}">
                                                <div class="mas-info sb-nav-link-icon mr-3 mt-1"><i
                                                        class="fas fa-edit mb-0"></i></div>
                                            </button>

                                            <div style="width: 100vw" class="modal fade" id="modal{{$archivo->id}}"
                                                 tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <form class="proyecto" method="POST"
                                                              id="formularioCambiarNombre"
                                                              action="{{route('cambiarNombre')}}">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">EDITAR
                                                                    NOMBRE DE FICHERO</h5>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="nombreArchivo" class="col-form-label">¿Que
                                                                        nombre deseas poner al archivo
                                                                        seleccionado?</label>
                                                                    <input type="text" class="form-control text-dark"
                                                                           id="nombreArchivo"
                                                                           name="nombreArchivo"
                                                                           value="{{$archivo->nombre}}">
                                                                </div>
                                                                <input type="hidden" value="{{$archivo->id}}" name="id"
                                                                       id="idArchivo">
                                                                <input type="hidden" value="{{$archivo->nombre}}" name="currentName" id="currentName">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cerrar
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Cambiar
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $archivo->size}}</td>
                                        <?php
                                        $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $archivo->fecha);
                                        ?>
                                        <td>{{ $fecha->format('d-m-Y H:i')}}</td>
                                        @foreach ($usuarios as $usuario)
                                            @if($usuario->id == $archivo->idusu)
                                                <td>{{ $usuario->usuario }}</td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <center><a href="{{asset($archivo->ruta)}}" download>


                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path
                                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                        <path
                                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                    </svg>
                                                </a></center>
                                        </td>
                                        <td>
                                            <center><a href="/borrarArchivo/{{$archivo->id}}">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                         fill="red"
                                                         class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </a></center>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade @if(session()->get('tarea')!="") show active @endif" id="nav-tareas"
                     role="tabpanel" aria-labelledby="nav-tareas-tab">

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button text-primary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Pendientes
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if(isset($tareasPendientes))
                                        <div class="d-flex flex-wrap">
                                            @if($tareasPendientes!=[])
                                                @foreach($tareasPendientes as $datosTareasPendientes)
                                                    <div class="col-12 col-sm-6 col-md-4 text-center">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <span style="font-size:20px;"  class="text-primary">{{$datosTareasPendientes->nombre}}</span>
                                                            </li>
                                                            <?php
                                                            $fecha = DateTime::createFromFormat('Y-m-d', $datosTareasPendientes->fecha_vencimiento);
                                                            ?>
                                                            <li>
                                                                <i class="fas fa-calendar-week text-primary"></i>&nbsp;<b>Hasta: </b>{{$fecha->format('d-m-Y')}}
                                                            </li>
                                                            <li>
                                                                <i class="far fa-user text-primary"></i>&nbsp;<b>Asignado
                                                                    a: </b>{{$datosTareasPendientes->usuario}}
                                                            </li>
                                                            <li class="mt-2">
                                                                <a href="/marcartarearealizada/{{$datosTareasPendientes->id}}"
                                                                   class="enlaces-tareas">
                                                                    <button type="button"
                                                                            class="btn btn-success btn-sm botones-tareas"><i
                                                                            class="fas fa-check text-white"></i></button>
                                                                </a>
                                                                <a href="/eliminartarea/{{$datosTareasPendientes->id}}"
                                                                   class="enlaces-tareas">
                                                                    <button type="button"
                                                                            class="btn btn-danger btn-sm botones-tareas"><i
                                                                            class="fas fa-times text-white"></i></button>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @else
                                                <span class="mr-5 w-100 text-center text-secondary">No hay tareas pendientes</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed text-primary" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                    Realizadas
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body ml-5">
                                    @if(isset($tareasRealizadas))
                                        <div class="d-flex flex-wrap">
                                            @if($tareasRealizadas!=[])
                                                @foreach($tareasRealizadas as $datosTareasRealizadas)
                                                <div class="col-12 col-sm-6 col-md-4 text-center">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <span style="font-size:20px;"
                                                                                class="text-primary">{{$datosTareasRealizadas->nombre}}</span>
                                                        </li>
                                                        <?php
                                                        $fecha = DateTime::createFromFormat('Y-m-d', $datosTareasRealizadas->fecha_vencimiento);
                                                        ?>
                                                        <li>
                                                            <i class="fas fa-calendar-week text-primary"></i>&nbsp;<b>Fecha
                                                                vencimiento: </b>{{$fecha->format('d-m-Y')}}
                                                        </li>
                                                        <li>
                                                            <i class="far fa-user text-primary"></i>&nbsp;<b>Asignado
                                                                a: </b>{{$datosTareasRealizadas->usuario}}
                                                        </li>
                                                        <li>
                                                            <a href="/eliminartarea/{{$datosTareasRealizadas->id}}"
                                                               class="enlaces-tareas">
                                                                <button type="button"
                                                                        class="btn btn-danger btn-sm botones-tareas"><i
                                                                        class="fas fa-times text-white"></i></button>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach

                                            @else
                                                <span class="mr-5 w-100 text-center text-secondary">No hay tareas realizadas</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed text-primary" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                    Crear tarea
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                 data-bs-parent="#accordionExample">
                                <form action="{{route('annadirTarea')}}" method="post">
                                    @csrf
                                    <div class="d-flex flex-wrap m-3 justify-content-lg-around">
                                        <div class="mr-3 mt-3 mb-0 input-group col-12 col-sm-8 col-lg-5 ">
                                            <span class="input-group-text" id="basic-addon1"
                                                  pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}">Nombre tarea:</span>
                                            <input type="text" class="form-control" name="nombre-tarea" placeholder=""
                                                   aria-label=""
                                                   aria-describedby="basic-addon1" required>
                                        </div>
                                        <div class="mr-3 mt-3 mb-0 input-group col-12 col-sm-8 col-lg-5">
                                            <span class="input-group-text"
                                                  id="basic-addon1">Fecha de vencimiento:</span>
                                            <input type="date" id="fecha-vencimiento" class="form-control"
                                                   placeholder="" aria-label=""
                                                   aria-describedby="basic-addon1" name="fecha-vencimiento" required>
                                        </div>
                                        <div class="mr-3 mt-3 mb-0 col-11">
                                            Asigna la tarea a un participante:
                                        </div>
                                        <div class="mr-3 mt-0 mb-0 col-11">
                                            <select class="form-select" name="personatarea"
                                                    aria-label="Default select example" required>
                                                <option selected="selected" value="Todos/as">Todos/as</option>
                                                @isset($usuariosPro)
                                                    @foreach($usuariosPro as $datosUsuarios)
                                                        <option
                                                            value="{{$datosUsuarios->nombreUsu}} {{ $datosUsuarios->apellidosUsu}}">{{$datosUsuarios->nombreUsu}} {{ $datosUsuarios->apellidosUsu}}
                                                            ({{ $datosUsuarios->usuarioUsu}})
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="mr-3 text-center mt-3 mb-0 col-11">
                                            <button type="submit" class="btn btn-primary" onclick="annadirTareas()">
                                                Añadir tarea
                                            </button>
                                        </div>
                                        <div id="erroresTypescript" class="w-100 mt-3"></div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade @if(session()->get('usuario-borrado')!="") show active @endif" id="nav-users"
                     role="tabpanel" aria-labelledby="nav-usuarios-tab">
                    <div class="tablatodos m-3">
                        <table class="table_of_users display compact stripe bg-primary" id="tables">
                            <thead>
                            <tr class="text-white">
                                <th>Nickname</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                @if($proyecto->idcreador == Session::get('id'))
                                    <th>
                                        <center>Eliminar del proyecto</center>
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @isset($usuariosPro)
                                @foreach ($usuariosPro as $datosUsuarios)
                                    <tr class="text-dark">
                                        <td><b>{{ $datosUsuarios->usuarioUsu}}</b></td>
                                        <td>{{ $datosUsuarios->nombreUsu}}</td>
                                        <td>{{ $datosUsuarios->apellidosUsu}}</td>
                                        <td>{{ $datosUsuarios->emailUsu}}</td>
                                        @if($proyecto->idcreador == Session::get('id'))
                                            @if (!($datosUsuarios->idUsu == Session::get('id')))
                                                <td>
                                                    <center><a href="/salirproyectoadmin/{{$datosUsuarios->idUsu}}">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                                 height="25"

                                                                 fill="red"
                                                                 class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                        </a></center>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>

                </div>


                @if(session()->get('id')==$proyecto->idcreador)

                    <div
                        class="tab-pane fade  @if((session()->get('errores')!="") || (session()->get('green')!="")) show active @endif"
                        id="nav-edit" role="tabpanel" aria-labelledby="nav-edit-tab">
                        <form class="user" method="POST" id="formulario" action="{{route('actualizarProyecto')}}">
                            @csrf
                            <div class="mt-5 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                                <div class="form-group row">
                                    <label for="nombreMostrar" class="col-4"> Nombre del proyecto:</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control text-dark" id="nombre" name="nombre"
                                               value="{{$proyecto->nombre}}" pattern="^[a-zA-ZÀ-ÿ_.0-9\s]{3,30}$"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="col-form-label">Descripción:</label>
                                        <textarea style="resize: none" rows="5" class="form-control" id="descripcion" name="descripcion" required>{{$proyecto->descripcion}}</textarea>
                                    </div>

                                    <input type="hidden" name="idproy" id="idproy" value="{{$proyecto->id}}">
                                    <input type="hidden" name="currentName" id="currentName"
                                           value="{{$proyecto->nombre}}">
                                    <input type="hidden" name="currentDes" id="currentDes"
                                           value="{{$proyecto->descripcion}}">
                                </div>
                            </div>
                        </form>
                        <form class="user" method="POST" id="formularioCodigo" action="{{route('generarNuevoCodigo')}}">
                            @csrf
                            <div class="mt-4 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                                <div class="form-group row">
                                    <label for="codigo" class="col-3 col-sm-2 offset-sm-4 offset-md-5 offset-xl-6">
                                        Codigo:</label>
                                    <div class="col-5 col-sm-4 col-md-3">
                                        <input type="text" class="form-control text-muted"
                                               id="codigo" name="codigo" value="{{$proyecto->codigo}}" disabled>
                                    </div>
                                    <input type="hidden" name="idproy" id="idproyecto" value="{{$proyecto->id}}">
                                    <div class="col-2 col-md-1">
                                        <a class="btn btn-primary" id="botonGenerarCodigo"><i
                                                class="fas fa-sync-alt"></i></a>
                                    </div>
                                </div>
                            </div>


                        </form>

                        <div class="mt-4 col-10 offset-1 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3">
                            @if((session()->get('green')!=""))
                                <div class='ml-3 mr-3 alert alert-success text-center'
                                     role='alert'>{!! session()->get('green')  !!}</div>
                            @endif
                            @if((session()->get('errores')!=""))
                                <div class='ml-3 mr-3 alert alert-success text-center'
                                     role='alert'>{!! session()->get('errores')  !!}</div>
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
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrar"
                                    data-bs-whatever="@getbootstrap">
                                Eliminar proyecto
                            </button>
                        </div>
                        <div style="width: 100vw" class="modal fade" id="borrar" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form class="user" method="POST" id="formularioBorrar"
                                          action="{{route('borrarProyecto')}}">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="idproy" id="idproyectoBorrar"
                                                   value="{{$proyecto->id}}">
                                            <p class="mt-2">¿Estás seguro de que deseas eliminar el proyecto de
                                                <b>"{{$proyecto->nombre}}"</b>? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>
                                            <button type="button" id="borrarProyecto" class="btn btn-primary">Borrar
                                                proyecto
                                            </button>
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
            <script src="/js/tareas.js"></script>



            <!-- tablas -->
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
                    crossorigin="anonymous"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
                    crossorigin="anonymous"></script>
            <script type="text/javascript">
                //var dt = require( 'datatables.net' )();
                $(document).ready(function () {
                    $('.table_of_users').DataTable();
                });
                $('.table_of_users').DataTable({
                    language: {
                        "processing": "Procesando...",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "emptyTable": "Ningún dato disponible en esta tabla",
                        "info": "_START_ al _END_ de un total de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "search": "Buscar:",
                        "infoThousands": ",",
                        "loadingRecords": "Cargando...",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        "aria": {
                            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad",
                            "collection": "Colección",
                            "colvisRestore": "Restaurar visibilidad",
                            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                            "copySuccess": {
                                "1": "Copiada 1 fila al portapapeles",
                                "_": "Copiadas %d fila al portapapeles"
                            },
                            "copyTitle": "Copiar al portapapeles",
                            "csv": "CSV",
                            "excel": "Excel",
                            "pageLength": {
                                "-1": "Mostrar todas las filas",
                                "1": "Mostrar 1 fila",
                                "_": "Mostrar %d filas"
                            },
                            "pdf": "PDF",
                            "print": "Imprimir"
                        },
                        "autoFill": {
                            "cancel": "Cancelar",
                            "fill": "Rellene todas las celdas con <i>%d<\/i>",
                            "fillHorizontal": "Rellenar celdas horizontalmente",
                            "fillVertical": "Rellenar celdas verticalmentemente"
                        },
                        "decimal": ",",
                        "searchBuilder": {
                            "add": "Añadir condición",
                            "button": {
                                "0": "Constructor de búsqueda",
                                "_": "Constructor de búsqueda (%d)"
                            },
                            "clearAll": "Borrar todo",
                            "condition": "Condición",
                            "conditions": {
                                "date": {
                                    "after": "Despues",
                                    "before": "Antes",
                                    "between": "Entre",
                                    "empty": "Vacío",
                                    "equals": "Igual a",
                                    "not": "No",
                                    "notBetween": "No entre",
                                    "notEmpty": "No Vacio"
                                },
                                "moment": {
                                    "after": "Despues",
                                    "before": "Antes",
                                    "between": "Entre",
                                    "empty": "Vacío",
                                    "equals": "Igual a",
                                    "not": "No",
                                    "notBetween": "No entre",
                                    "notEmpty": "No vacio"
                                },
                                "number": {
                                    "between": "Entre",
                                    "empty": "Vacio",
                                    "equals": "Igual a",
                                    "gt": "Mayor a",
                                    "gte": "Mayor o igual a",
                                    "lt": "Menor que",
                                    "lte": "Menor o igual que",
                                    "not": "No",
                                    "notBetween": "No entre",
                                    "notEmpty": "No vacío"
                                },
                                "string": {
                                    "contains": "Contiene",
                                    "empty": "Vacío",
                                    "endsWith": "Termina en",
                                    "equals": "Igual a",
                                    "not": "No",
                                    "notEmpty": "No Vacio",
                                    "startsWith": "Empieza con"
                                }
                            },
                            "data": "Data",
                            "deleteTitle": "Eliminar regla de filtrado",
                            "leftTitle": "Criterios anulados",
                            "logicAnd": "Y",
                            "logicOr": "O",
                            "rightTitle": "Criterios de sangría",
                            "title": {
                                "0": "Constructor de búsqueda",
                                "_": "Constructor de búsqueda (%d)"
                            },
                            "value": "Valor"
                        },
                        "searchPanes": {
                            "clearMessage": "Borrar todo",
                            "collapse": {
                                "0": "Paneles de búsqueda",
                                "_": "Paneles de búsqueda (%d)"
                            },
                            "count": "{total}",
                            "countFiltered": "{shown} ({total})",
                            "emptyPanes": "Sin paneles de búsqueda",
                            "loadMessage": "Cargando paneles de búsqueda",
                            "title": "Filtros Activos - %d"
                        },
                        "select": {
                            "1": "%d fila seleccionada",
                            "_": "%d filas seleccionadas",
                            "cells": {
                                "1": "1 celda seleccionada",
                                "_": "$d celdas seleccionadas"
                            },
                            "columns": {
                                "1": "1 columna seleccionada",
                                "_": "%d columnas seleccionadas"
                            }
                        },
                        "thousands": "."
                    }
                });
                $('.tables').dataTable({
                    scrollY: true
                });
                $('.tables').dataTable({
                    scrollX: true
                });
            </script>

@endsection
