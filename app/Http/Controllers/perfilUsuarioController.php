<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class perfilUsuarioController extends Controller
{

    function recuperarContrasena(Request $request)
    {

        //FALTA LA ENCRIPTACIÓN
        $email = request("email");
        $pass = request("pass");

        $solicitantes = Usuario::get();

        $encriptada = password_hash(request("pass"), PASSWORD_DEFAULT);


        foreach ($solicitantes as $usuario){
            if($email == $usuario->email ){
                $usuario = DB::table("usuario")->where('id', $usuario->id)->update([
                    "password" => $encriptada,
                ]);

                $subject = "Recuperación de contraseña";

                Mail::send('email.email', request()->all(), function($msj) use($subject,$email){
                    $msj->from("developersweapp@gmail.com","EgiConnect");
                    $msj->subject($subject);
                    $msj->to($email);
                });

              return redirect('/');
           }
        }
       return back()->with('error', 'El correo no existe.');
    }

    public function listarUsuario()
    {

        $id = session()->get('id');
        $usuario = Usuario::get()->where('id', $id)->first();
        return view("perfil", [
            "usuario"=>$usuario
        ]);

    }

    public function actualizar(Request $request)
    {


        $currentUser = session()->get('usuario');
        $currentEmail = session()->get('correo');
        $currentId = session()->get('id');

        $usuario = request('usuario');
        $email = request('email');

        $errores = '';
        $datosUsuario = [];
        $datosEmail = [];

        if( $currentUser != $usuario ){
            $datosUsuario = Usuario::get()->where('usuario', $usuario)->first();
            if ($datosUsuario!=""){
                $errores = $errores . 'El usuario no es válido. Escribe otro.<br>';
            }
        }

        if( $currentEmail != $email ){
            $datosEmail = Usuario::get()->where('email', $email)->first();
            if ($datosEmail!=""){
                $errores = $errores . 'El correo no es válido. Escribe otro.';
            }
        }




        if (empty($errores)){
            $usu = DB::table('usuario')->where('id',$currentId)->update([
                "usuario" => $usuario,
                "nombre" => request("nombre"),
                "apellidos" => request("apellidos"),
                "email" => $email,
            ]);

            Session::put('usuario', $usuario);
            Session::put('nombre', request('nombre'));
            Session::put('correo', $email);


            return redirect()->route('perfil');
        }
        return back()->with(['errores' => $errores]);


    }

    function cambiarContrasena()
    {

        $currentId = session()->get('id');
        $currentUser = Usuario::get()->where('id', $currentId)->first();


        if(!password_verify ( request('currentPass') , $currentUser->password )){
            $error = 'La contraseña actual es erronea.';
            return back()->with(['errorPass' => $error]);
        }

        if(request('pass')!=request('pass2')){
            $error = 'Las contraseñas no coinciden.';
            return back()->with(['errorPass' => $error]);
        }

        $encriptada = password_hash(request("pass"), PASSWORD_DEFAULT);

        $usuario = DB::table('usuario')->where('ID', $currentId)->update([
            "password" => $encriptada,
        ]);

        return redirect()->route('perfil');

    }

}


