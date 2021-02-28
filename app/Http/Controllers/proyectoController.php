<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Usupro;
use Illuminate\Http\Request;
use DB;
use Session;

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

        $proyectosIDs = Usupro::get()->where('idusu', request("idcreador"));
        $proyectos = [];
        foreach ($proyectosIDs as $datosProyectos){
            $project = DB::select('select * from proyecto where id= ?', [$datosProyectos->idproy]);
            array_push($proyectos, $project);
        }
        Session::put('proyectos', $proyectos);

        return redirect()->route('index');
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

        $proyectoExistente = Usupro::get()->where('idusu', request("idusu"))->where('idproy', $idproy->id)->first();

        if($proyectoExistente!=""){
            return back()->with('error', 'Ya estás unido a ese proyecto.');
        }

        $usuPro->save();


        $proyectosIDs = Usupro::get()->where('idusu', request("idusu"));
        $proyectos = [];
        foreach ($proyectosIDs as $datosProyectos){
            $project = DB::select('select * from proyecto where id= ?', [$datosProyectos->idproy]);
            array_push($proyectos, $project);
        }
        Session::put('proyectos', $proyectos);

        return redirect()->route('index');
    }

    public function show($id)
    {
        Session::put('proyectoid', $id);
        $mensajes = DB::select('SELECT * FROM chat WHERE idproy = ? ',[$id]);
        $proyecto = Proyecto::get()->where('id', $id)->first();
        return view('proyects')->with([
            "mensajes" => $mensajes,
            "proyecto" => $proyecto,
        ]);

    }
    //método para guardar los mensajes del chat
    public function chat(Request $request)
    {
        DB::table('chat')->insert([
            'descripcion' => $request->mensaje,
            'fecha' => now(),
            'idusu' => session()->get('id'),
            'idproy' => session()->get('proyectoid'),
        ]);

        return $this->show(session()->get('proyectoid'));

    }

    public function actualizar(Request $request)
    {


        $nombreProyecto = request('nombre');
        $descripcion = request('descripcion');
        $idproy = request('idproy');
        $idusu = Session::get('id');


        $nombreExistente = Proyecto::get()->where('nombre', $nombreProyecto)->first();

        if( $nombreProyecto != request('currentName') ){
            if( $nombreExistente!=''){
            return back()->with('errores', 'El nombre del proyecto no está disponible.');
            }
        }

        $pro = DB::table('proyecto')->where('id',$idproy)->update([
            "nombre" => $nombreProyecto,
            "descripcion" => $descripcion
        ]);



        $proyectosIDs = Usupro::get()->where('idusu', $idusu);
        $proyectos = [];
        foreach ($proyectosIDs as $datosProyectos){
            $project = DB::select('select * from proyecto where id= ?', [$datosProyectos->idproy]);
            array_push($proyectos, $project);
        }
        Session::put('proyectos', $proyectos);

        return back()->with('green', 'El proyecto ha sido actualizado correctamente.');

    }


    public function generarNuevoCodigo(Request $request)
    {
        $idproy = request('idproy');

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

        $proyecto = DB::table('proyecto')->where('id',$idproy)->update([
            "codigo" => $codigo,
        ]);

        return back()->with('green', 'El código del proyecto ha sido actualizado.');

    }

    public function borrarProyecto()
    {
        $idproy = request('idproy');
        $idusu = Session::get('id');

        $proyecto = Proyecto::where('id', $idproy)->delete();

        $proyectosIDs = Usupro::get()->where('idusu', $idusu);
        $proyectos = [];
        foreach ($proyectosIDs as $datosProyectos) {
            $project = DB::select('select * from proyecto where id= ?', [$datosProyectos->idproy]);
            array_push($proyectos, $project);
        }
        Session::put('proyectos', $proyectos);

        return redirect()->route('index');
    }



    public function salirProyecto()
    {
        $idproy = request('idproy');
        $idusu = Session::get('id');

        $proyecto = Usupro::where('idproy', $idproy)->where('idusu',$idusu)->delete();

        $proyectosIDs = Usupro::get()->where('idusu', $idusu);
        $proyectos = [];
        foreach ($proyectosIDs as $datosProyectos){
            $project = DB::select('select * from proyecto where id= ?', [$datosProyectos->idproy]);
            array_push($proyectos, $project);
        }
        Session::put('proyectos', $proyectos);

        return redirect()->route('index');

    }

}








