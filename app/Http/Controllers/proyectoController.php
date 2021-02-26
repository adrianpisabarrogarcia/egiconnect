<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Usupro;
use Illuminate\Http\Request;

class proyectoController extends Controller
{
    public function crearProyecto()
    {
        $codigoRepetido = 0;
        do {
            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $codigo = substr(str_shuffle($permitted_chars), 0, 5);
            $lista = Proyecto::get();
            foreach ($lista as $elemento) {
                if ($elemento->codigo == $codigo) {
                    $codigoRepetido = 1;
                }
            }
        } while ($codigoRepetido == 1);

        $proyecto = new Proyecto(
            [
                "nombre" => request("nombre"),
                "descripcion" => request("descripcion"),
                "codigo" => $codigo,
                "idcreador" => request("idcreador"),
            ]
        );


        //Verificamos si el codigo está en uso.
        $lista = Proyecto::get();
        foreach ($lista as $elemento) {
            if ($elemento->nombre == request("nombre")) {
                return back()->with('error', 'El nombre del proyecto ya está en uso.');
            }
        }

        $proyecto->save();

        $idproyecto = $proyecto->id;


        $usuPro = new Usupro(
            [
                "idproy" => $idproyecto,
                "idusu" => request("idcreador"),
            ]
        );


        $usuPro->save();

        return redirect()->route('index');
    }


    public function show($id)
    {

        return view('proyects');

    }
  
    public function unirseProyecto()
    {

        //Verificamos si el codigo existe.
        $idproy = Proyecto::get()->where('codigo', request("codigoProyecto"));
        if(count($idproy)==0){
            return back()->with('error', 'El codigo del proyecto no existe.');
        }

        $idproy = Proyecto::get()->where('codigo', request("codigoProyecto"))->first();
        $usuPro  = new Usupro(
            [
                "idproy" => $idproy->id,
                "idusu" => request("idusu"),
            ]
        );

        $usuPro->save();

        return redirect()->route('index');
    }

}
