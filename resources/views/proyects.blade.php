@extends('layout.layout-menus')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <nav>
            <div class="mt-2 nav nav-tabs" id="nav-tab" role="tablist">
                <button class="ml-2 nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Chat</button>
                <button class="nav-link" id="nav-files-tab" data-bs-toggle="tab" data-bs-target="#nav-files" type="button" role="tab" aria-controls="nav-files" aria-selected="false">Archivos</button>
                <button class="nav-link" id="nav-tareas-tab" data-bs-toggle="tab" data-bs-target="#nav-tareas" type="button" role="tab" aria-controls="nav-tareas" aria-selected="false">Tareas</button>
                <button class="nav-link" id="nav-usuarios-tab" data-bs-toggle="tab" data-bs-target="#nav-users" type="button" role="tab" aria-controls="nav-users" aria-selected="false">Usuarios</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="chat_window">
                    <div class="top_menu">
                        <div class="buttons">
                            <div class="button close"></div>
                            <div class="button minimize"></div>
                            <div class="button maximize"></div>
                        </div>
                        <div class="title">Chat</div>
                    </div>
                    <ul class="messages"></ul>
                    <div class="bottom_wrapper clearfix">
                        <div class="message_input_wrapper">
                            <input class="message_input" placeholder="Type your message here..." />
                        </div>
                        <div class="send_message">
                            <div class="icon"></div>
                            <div class="text">Send</div>
                        </div>
                    </div>
                </div>
                <div class="message_template">
                    <li class="message">
                        <div class="avatar"></div>
                        <div class="text_wrapper">
                            <div class="text"></div>
                        </div>
                    </li>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-files" role="tabpanel" aria-labelledby="nav-files-tab">...</div>
            <div class="tab-pane fade" id="nav-tareas" role="tabpanel" aria-labelledby="nav-tareas-tab">...</div>
            <div class="tab-pane fade" id="nav-usuarios" role="tabpanel" aria-labelledby="nav-usuarios-tab">...</div>

        </div>

    </main>


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>    <script src="js/scripts.js"></script>
    <script src="js/dark-mode-switch.min.js"></script>
    <script src="assets/demo/datatables-demo.js"></script>
@endsection