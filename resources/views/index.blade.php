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

    </main>


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>    <script src="js/scripts.js"></script>
    <script src="js/dark-mode-switch.min.js"></script>
    <script src="assets/demo/datatables-demo.js"></script>
@endsection
