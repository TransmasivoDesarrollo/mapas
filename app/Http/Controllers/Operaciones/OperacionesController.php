<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\t_bitacora_terminales;
use DB;
use Dompdf\Dompdf;

use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth

class OperacionesController extends Controller
{
    public function __construct()
	{

		$this->middleware(['auth']);
	}

    public function Bitacora_de_operaciones()
    {
        $consulta = t_bitacora_terminales::whereBetween('fecha_registro', [now()->format('Y-m-d').' 00:00:00', now()->format('Y-m-d').' 23:59:00'])->get();

        
        $terminal = DB::connection('mysql_produc')->select('SELECT *from c_terminal');
        return view('Transmasivo.Operaciones.Bitacora_de_operaciones',compact('terminal','consulta'));
    }
    
    public function Registro_bitacora_terminal(Request $request)
    {
        if($request->has("pdf"))
        {
            $this->generarPDF();
        }else{
            $terminal=$request->input('terminal');
            $hora_llegada=$request->input('hora_llegada');
            $serv=$request->input('serv');
            $jorn=$request->input('jorn');
            $eco=$request->input('eco');
            $credencial=$request->input('credencial');
            $km=$request->input('km');
            $hora_salida=$request->input('hora_salida');
            $comentarios=$request->input('comentarios');

            date_default_timezone_set('America/Mexico_City');
            $hora_actual = time();

            $hora_una_hora_atras = $hora_actual - 3600;

            $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);

            $bitacora = new t_bitacora_terminales();
            $bitacora->terminal = $terminal;
            $bitacora->hora_llegada = $hora_llegada;
            $bitacora->Servicio = $serv; // Ajusta el nombre del campo según corresponda en tu tabla
            $bitacora->Jornada = $jorn; // Ajusta el nombre del campo según corresponda en tu tabla
            $bitacora->eco = $eco;
            $bitacora->credencial = $credencial;
            $bitacora->kilometraje = $km;
            $bitacora->hora_salida = $hora_salida;
            $bitacora->comentario = $comentarios;
            $bitacora->fecha_registro = $hora_formateada; // Fecha de registro actual
            $bitacora->id_usuario = Auth::id();
            
            // Guardar el registro en la base de datos
            $bitacora->save();
            
            $mensaje="Se registro con exito!";
            $color="success";
            return redirect()->route('Bitacora_de_operaciones')->with('mensaje', $mensaje)->with('color', $color);
        }
        
    }
    public function generarPDF()
    {
        $html = view('Transmasivo.Operaciones.reporte_bitacora_terminal')->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->stream('Bitacora de terminales .pdf');

    }

    public function Alta_de_reporte()
    {
        $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
        INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4)');
        $servicios = DB::connection('mysql_produc')->select('SELECT * from  cservicios WHERE idservicio IN(5,6,7,8)');
        $grupos = DB::connection('mysql_produc')->select('SELECT * from  cfallosgrales ');
        return view('Transmasivo.Operaciones.Alta_de_reporte',compact('unidades','servicios','grupos'));
    }
    public function catalogo_subgrupo(Request $request)
    {
        //return $request->all();
        return DB::connection('mysql_produc')->select('SELECT * FROM cdescfallo where falloGralfkcfallosgrales= '.$request->input("grupo_id"));
        
    }
    
    

    
}
