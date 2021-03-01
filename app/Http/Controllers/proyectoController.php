<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
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

        foreach($mensajes as $datosMensajes){
            $datoUsuario = DB::select('SELECT nombre FROM usuario WHERE id = ?',[$datosMensajes->idusu]);
            $datosMensajes->nombre = $datoUsuario[0]->nombre;
        }

        $proyecto = Proyecto::get()->where('id', $id)->first();

        $usuariosProyecto = DB::select('SELECT * FROM usupro WHERE idproy = ?',[$id]);
        foreach($usuariosProyecto as $datosUsuariosProyectos){
            $usuario = DB::select('SELECT * FROM usuario WHERE id = ?',[$datosUsuariosProyectos->idusu]);
            $datosUsuariosProyectos->idUsu = $usuario[0]->id;
            $datosUsuariosProyectos->usuarioUsu = $usuario[0]->usuario;
            $datosUsuariosProyectos->nombreUsu = $usuario[0]->nombre;
            $datosUsuariosProyectos->apellidosUsu = $usuario[0]->apellidos;
            $datosUsuariosProyectos->emailUsu = $usuario[0]->email;
        }

        $usuarios = DB::select('SELECT * FROM usuario');


        return view('proyects')->with(["mensajes" => $mensajes, "proyecto" => $proyecto, "usuarios" => $usuariosProyecto]);
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

    public function salirProyectoAdmin($id)
    {
        $idproy = Session::get('proyectoid');
        $idusu = $id;

        DB::table('usupro')->where('idproy', '=', $idproy)->where('idusu', '=', $idusu)->delete();

        return back();

    }

    function subirArchivo(Request $request){

        $idusu = Session::get('id');
        $idproy = request('idproy');

        $nombreArchivo = request("archivo");
        $archivo = $request->file("archivo");
        return $archivo;
        $nombreHash = $request->file("archivo")->hashName();
        $archivo->move('/archivos/' , $nombreHash);
        $tamaño = filesize($archivo);
        return $tamaño;

        date_default_timezone_set ('Europe/Madrid');
        $now = new DateTime();

        //Tratar los dates.
        $archivo  = new Archivo(
            [
                "ruta" => "/archivos/" . $nombreHash,
                "idproy" => $idproy,
                "idusu" => $idusu,
                "fecha" => $now,
                "size" => $tamaño,
            ]
        );
        $obra->save();

        $solicitante = Solicitante::get()->where('ID', $_COOKIE['usuarioConectado'])->first();
        $listaSolicitantes = DB::table("obras")->where('IDSOLICITANTE', $solicitante["ID"])->simplePaginate(10);

        $listaUbicaciones = Ubicacion::get();

        return view("listaObrasSolicitante", [
            "listaSolicitantes"=>$listaSolicitantes,
            'listaUbicaciones' => $listaUbicaciones
        ]);
    }


}








