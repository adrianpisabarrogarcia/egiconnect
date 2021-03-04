<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use DB;
use Session;
use DateTime;

class archivoController extends Controller
{
    function subirArchivo(Request $request){


        $idusu = Session::get('id');
        $idproy = request('idproy');

        $nombreArchivo = $_FILES['archivo']['name'];
        $archivo = $request->file("archivo");

        $nombreHash = $request->file("archivo")->hashName();
        $archivo->move('archivos/' , $nombreHash);
        $now = now();

        //Calcular tamaño del archivo
        $size = filesize($archivo);

        if ($size >= 1048576)
        { $size = number_format($size / 1048576, 2) . ' MB'; }
        elseif ($size >= 1024)
        { $size = number_format($size / 1024, 2) . ' KB'; }
        
        //Obtener fecha actual
        date_default_timezone_set ('Europe/Madrid');
        $now = new DateTime();

        //Tratar los dates.
        $archivo  = new Archivo(
            [
                "nombre" => $nombreArchivo,
                "ruta" => "archivos/" . $nombreHash,
                "idproy" => $idproy,
                "idusu" => $idusu,
                "fecha" => $now,
                "size" => $size,
            ]
        );
        $archivo->save();

        //Returnear la vista con la pestaña de archivos
        return back()->with('file','file');

    }

    //función para borrar los archivos
    public function borrarArchivo($id)
    {
        $idproy = Session::get('proyectoid');

        $archivo = Archivo::where('id', $id)->where('idproy',$idproy)->delete();

        return back()->with('file','file');

    }

    //función para cambiar el nombre, evita que se cambie la extensión del archivo
    public function cambiarNombre()
    {
        $idproy = Session::get('proyectoid');
        $nombre = request('nombreArchivo');
        $current = request('currentName');

        $id = request('id');

        $nombreArray = explode('.',$nombre);
        $currentName = explode('.',$current);

        $extension = ".". end($currentName);

        $nombreFinal = $nombreArray['0'] .$extension;

        $pro = DB::table('archivo')->where('id',$id)->update([
            "nombre" => $nombreFinal,
        ]);

        return back()->with('file','file');

    }


}
