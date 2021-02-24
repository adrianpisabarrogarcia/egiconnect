<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //Recogemos los datos
        $user = $request->get('user');
        $password = $request->get('password');

        //Consultamos a la bd
        $datosUsuario = DB::select('select * from usuario where usuario= ?', [$user]);
        $datosEmail = DB::select('select * from usuario where usuario= ?', [$user]);
        //En caso de que encuentre un objeto guardaremos el dni
        if ($datosUsuario != null || $datosEmail != null) {
            if ($datosUsuario != null){
                if (Hash::check($password, $datosUsuario[0]->password)) {
                    Session::put('id', $datosUsuario[0]->id);
                    Session::put('usuario', $user);
                    Session::put('nombre', $datosUsuario[0]->nombre);
                    Session::put('correo', $datosUsuario[0]->email);
                    return redirect()->route('login.home');
                }
            }else{
                if (Hash::check($password, $datosEmail[0]->password)) {
                    Session::put('id', $datosEmail[0]->id);
                    Session::put('usuario', $datosEmail[0]->usuario);
                    Session::put('nombre', $datosEmail[0]->nombre);
                    Session::put('correo', $user);
                    return redirect()->route('login.home');
                }
            }
        }

        return view('login/login', [
            'error' => 'Usuario o contraseña incorrecto.',
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
