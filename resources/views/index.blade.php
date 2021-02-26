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
            <h3 class="ms-4 p-2"><i class="fas fa-tools"></i>&nbsp;Gestión de proyectos:</h3>
            <div class="row d-flex justify-content-center align-center">
                <div class="col-6 d-flex justify-content-center p-5">
                    <button type="button" class="btn btn-outline-primary btn-lg w-100"><i
                            class="fas fa-plus-circle"></i>&nbsp;&nbsp;CREAR PROYECTO
                    </button>
                </div>
                <div class="col-6 d-flex justify-content-center p-5">
                    <button type="button" class="btn btn-outline-primary btn-lg w-100"><i class="fas fa-unlock-alt"></i>&nbsp;&nbsp;UNIRTE
                        AL PROYECTO
                    </button>
                </div>
            </div>


            <h3 class="ms-4 p-2"><i class="fas fa-comment-dots"></i>&nbsp;Útimos mensajes:</h3>
            <div class="row d-flex justify-content-evenly p-4">
                <div class="col-3">
                    <div class="card text-dark bg-light mb-3 ">
                        <div class="card-header">Nombre proyecto</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-reply"></i>&nbsp;&nbsp;Pepe:</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </div><div class="col-3">
                    <div class="card text-dark bg-light mb-3 ">
                        <div class="card-header">Nombre proyecto</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-reply"></i>&nbsp;&nbsp;Pepe:</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </div><div class="col-3">
                    <div class="card text-dark bg-light mb-3 ">
                        <div class="card-header">Nombre proyecto</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-reply"></i>&nbsp;&nbsp;Pepe:</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </div><div class="col-3">
                    <div class="card text-dark bg-light mb-3 ">
                        <div class="card-header">Nombre proyecto</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-reply"></i>&nbsp;&nbsp;Pepe:</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </div><div class="col-3">
                    <div class="card text-dark bg-light mb-3 ">
                        <div class="card-header">Nombre proyecto</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-reply"></i>&nbsp;&nbsp;Pepe:</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </div><div class="col-3">
                    <div class="card text-dark bg-light mb-3 ">
                        <div class="card-header">Nombre proyecto</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-reply"></i>&nbsp;&nbsp;Pepe:</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </div><div class="col-3">
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
                <div class="col-3">
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

@endsection
