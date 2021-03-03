<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Mail;
use Session;

class ControladorLogin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //guardo lo datos del registro
        $usuario = $request->get('usuario');
        $email = $request->get('email');
        $datosUsuario = DB::select('select usuario from usuario where usuario = ?', [$usuario]);
        $datosEmail = DB::select('select email from usuario where email = ?', [$email]);
        $errores = '';
        if (count($datosUsuario) > 0) {
            $errores = $errores . 'El usuario no es válido. Escribe otro.<br>';
        }
        if (count($datosEmail) > 0) {
            $errores = $errores . 'El correo no es válido. Escribe otro.';
        }

        if (empty($errores)) {
            //utilizar este método para guardar la info recibida por parámetro
            DB::table('usuario')->insert([
                'usuario' => $request->get('usuario'),
                'nombre' => $request->get('nombre'),
                'apellidos' => $request->get('apellidos'),
                'password' => Hash::make($request->get('password')),
                'email' => $request->get('email')
            ]);

            $this->contacto($request);

            return redirect()->route('login.home');
        }
        return view("login/register", ['errores' => $errores]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {


        //Recogemos los datos
        $user = $request->get('user');
        $password = $request->get('password');

        //Consultamos a la bd
        $datosUsuario = DB::select('select * from usuario where usuario= ?', [$user]);
        $datosEmail = DB::select('select * from usuario where email= ?', [$user]);
        //En caso de que encuentre un objeto guardaremos el dni
        if ($datosUsuario != null || $datosEmail != null) {
            if ($datosUsuario != null) {
                if (Hash::check($password, $datosUsuario[0]->password)) {
                    Session::put('id', $datosUsuario[0]->id);
                    Session::put('usuario', $user);
                    Session::put('nombre', $datosUsuario[0]->nombre);
                    Session::put('correo', $datosUsuario[0]->email);
                    $this->datosNecesarios($datosUsuario);
                    return redirect()->route('index');
                }
            } else {
                if (Hash::check($password, $datosEmail[0]->password)) {
                    Session::put('id', $datosEmail[0]->id);
                    Session::put('usuario', $datosEmail[0]->usuario);
                    Session::put('nombre', $datosEmail[0]->nombre);
                    Session::put('correo', $user);
                    $this->datosNecesarios($datosEmail);
                    return redirect()->route('index');
                }
            }
        }

        return view('login/login', [
            'error' => 'Usuario o contraseña incorrecto.',
        ]);
    }

    public function showIndex(){
        if (!Session::exists('id')) {
            return redirect()->route("login.home");
        } else {
            return redirect()->route('index');
        }
    }

    public function datosNecesarios($datosUsuario)
    {
        $proyectosIDs = DB::select('select * from usupro where idusu = ?', [$datosUsuario[0]->id]);
        $proyectos = [];
        foreach ($proyectosIDs as $datosProyectos) {
            $project = DB::select('select * from proyecto where id = ?', [$datosProyectos->idproy]);
            array_push($proyectos, $project);
        }
        $ultimosMensajes = [];
        foreach ($proyectosIDs as $datosProyectos) {
            $project = DB::select('SELECT * FROM chat WHERE idproy = ? ORDER BY id DESC', [$datosProyectos->idproy]);
            foreach ($project as $datosProject) {
                if ($datosProject->idusu != $datosUsuario[0]->id) {
                    $aux = DB::select('SELECT usuario FROM usuario WHERE id = ?', [$datosProject->idusu]);
                    $datosProject->nombreusu = $aux[0]->usuario;
                    $aux = DB::select('SELECT nombre FROM proyecto WHERE id = ?', [$datosProject->idproy]);
                    $datosProject->nombreproy = $aux[0]->nombre;
                    array_push($ultimosMensajes, $datosProject);
                }
            }
        }
        Session::put('proyectos', $proyectos);
        Session::put('ultimosMensajes', $ultimosMensajes);
    }

    public function logOut()
    {
        session()->flush();
        return redirect()->route('login.home');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function contacto(Request $request)
    {
        $subject = "Bienvenido/a " . $request['nombre']; //asunto
        $for = $request['email']; //a quien se lo voy a enviar
        //vista          //le paso los datos del request
        Mail::send('email.register', $request->all(), function ($msj) use ($subject, $for) {
            $msj->from("developersweapp@gmail.com", "EgiConnect"); //de quien
            $msj->subject($subject);
            $msj->to($for);
        });
    }
}
