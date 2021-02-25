<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
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

}
