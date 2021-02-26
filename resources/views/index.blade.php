@extends('layout.layout-menus')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="index-buttons mb-3 col-12 mb-sm-0 col-sm-5 offset-sm-1 col-md-4 offset-md-2">
                <button type="button" class="btn btn-primary btn-lg">CREAR SALA</button>
            </div>
            <div class="index-buttons col-12 col-sm-5 col-md-4">
                <button type="button" class="btn btn-primary btn-lg">UNIRSE A SALA</button>
            </div>
        </div>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crear" data-bs-whatever="@getbootstrap">CREAR SALA</button>

        <div style="width: 100vw" class="modal fade" id="crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="proyecto" method="POST" id="formulario" action="{{route('crearProyecto')}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">CREA TU PROPIA SALA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nombre de la sala:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe el nombre del proyecto">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Descripción:</label>
                                    <textarea style="resize: none" rows="5" class="form-control" id="descripcion" name="descripcion" placeholder="Escribe una breve descripcion del proyecto"></textarea>
                                </div>
                                <input type="hidden" name="codigo" id="codigo">
                                <input type="hidden" name="idcreador" id="creador" value="31">
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

    </main>


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>    <script src="js/scripts.js"></script>
    <script src="js/dark-mode-switch.min.js"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script src="js/proyectos.js"></script>
@endsection
