@extends('layout.layout-menus')
@section('content')
    <link rel="stylesheet" href="/css/portal.css">
    <style>
        main {
            overflow: hidden;
        }
    </style>
    </head>
    <div id="layoutSidenav_content">
        <main class="p-2">
            <h3 class="mt-3 ms-4 p-2"><i class="fas fa-tools"></i>&nbsp;Gestión de proyectos:</h3>
            <div class="row d-flex justify-content-center align-center">
                <div class="col-12 col-sm-6 d-flex justify-content-center p-2 p-sm-5">
                    <button type="button" class="btn btn-outline-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#crear" data-bs-whatever="@getbootstrap"><i
                            class="fas fa-plus-circle"></i>&nbsp;&nbsp;CREAR PROYECTO
                    </button>
                </div>
                <div style="width: 100vw" class="modal fade" id="crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="proyecto" method="POST" id="formulario" action="{{route('crearProyecto')}}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">CREA TU PROPIO PROYECTO</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="nombre" class="col-form-label">Nombre del proyecto:</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe el nombre del proyecto" pattern="^[a-zA-ZÀ-ÿ_.0-9\s]{3,30}$" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion" class="col-form-label">Descripción:</label>
                                            <textarea style="resize: none" rows="5" class="form-control" id="descripcion" name="descripcion" placeholder="Escribe una breve descripcion del proyecto" required></textarea>
                                        </div>
                                        <input type="hidden" name="codigo" id="codigo">
                                        <input type="hidden" name="idcreador" id="creador" value="{{ session()->get('id') }}">
                                        <div id="erroresTypescript">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" id="botonCrearProyecto" class="btn btn-primary">Crear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 d-flex justify-content-center p-2 p-sm-5">
                    <button type="button" class="btn btn-outline-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#unirse" data-bs-whatever="@getbootstrap">
                        <i class="fas fa-unlock-alt" ></i>&nbsp;&nbsp;UNIRTE
                        AL PROYECTO
                    </button>
                </div>
                <div style="width: 100vw" class="modal fade" id="unirse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="proyecto" method="POST" id="formulario2" action="{{route('unirseProyecto')}}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">UNETE A UN PROYECTO</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="codigoProyecto" class="col-form-label">Codigo del proyecto:</label>
                                            <input  style="text-transform: uppercase;" maxlength="5" minlength="5" type="text" class="form-control" id="codigoProyecto" name="codigoProyecto" placeholder="Escribe el codigo del proyecto para unirte">
                                        </div>
                                        <input type="hidden" name="idusu" id="idusu" value="{{ session()->get('id') }}">
                                        <div id="erroresTypescript2">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" id="botonUnirseProyecto" class="btn btn-primary">Unirse</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if((session()->get('error')!=""))
                <div class="mt-5 ml-4 mr-4 alert alert-danger alert-dismissible fade show text-center" role="alert">
                    {!! session()->get('error')  !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h3 class="ms-4 p-2"><i class="fas fa-comment-dots"></i>&nbsp;Útimos mensajes:</h3>
            <div class="row d-flex justify-content-evenly p-4">
                <div class="col-12 col-sm-3">
                    <div class="card text-dark bg-light mb-3 ">
                        <div class="card-header">Nombre proyecto</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-reply"></i>&nbsp;&nbsp;Pepe:</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @endsection
        @section('scripts')
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
                    crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="js/dark-mode-switch.min.js"></script>
            <script src="assets/demo/datatables-demo.js"></script>
            <script src="js/proyectos.js"></script>
@endsection
