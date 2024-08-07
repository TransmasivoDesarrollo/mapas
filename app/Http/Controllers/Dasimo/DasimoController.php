<?php

namespace App\Http\Controllers\Dasimo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory; 
use App\Exports\inventario_dasimoExport;

class DasimoController extends Controller
{
    public function __construct()
	{

		$this->middleware(['auth']);
	}

    public function Registro_de_inventario()
    {
        return view('Transmasivo.Dasimo.Registro_de_inventario');
    }

    public function postRegistro_de_inventario(Request $request)
    {
        $Nombre_inventario=$request->input('Inventario');
        $Cantidad=$request->input('Cantidad');
        $Categoria=$request->input('Categoria');
        $file =$request->file('Foto');
        
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_una_hora_atras = $hora_actual - 0;
        $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
        $hora_formateada2 = date('Y_m_d_H_i_s', $hora_una_hora_atras);
        $NombreFinal;
        if($file==null || $file==""){
            $NombreFinal="sin_foto.jpg";
        }else{
            $extension = $file->getClientOriginalExtension();
            $NombreFinal = $hora_formateada2.".".$extension;
            $file->move(public_path().'/images/Inventario_dasimo/',$NombreFinal);
        }
        

        DB::connection('mysql')->table('t_inventario_dasimo')->insert([
            'nombre' => $Nombre_inventario,
            'cantidad' => $Cantidad,
            'categoria' => $Categoria,
            'foto' => $NombreFinal,
            'fecha_creacion' => $hora_formateada
        ]);
        
        $mensaje="Se registro con exito!";
        $color="success";
        
        return redirect()->route('Registro_de_inventario')->with('mensaje', $mensaje)->with('color', $color);
    }
    public function DasimoConsultar_caja_herramienta()
    {
        $inventario=DB::connection('mysql')->select('select * from  t_inventario_dasimo');
        return view('Transmasivo.Dasimo.DasimoConsultar_caja_herramienta',compact('inventario'));
    }
    public function post_DasimoConsultar_caja_herramienta()
    {
        $inventario=DB::connection('mysql')->select('select * from  t_inventario_dasimo');

        $mensaje="Se registro con exito!";
        $color="success";
        
       return Excel::download(new inventario_dasimoExport, 'inventario.xlsx');
    }
    public function Solicitar_suministro()
    {
        $inventario=DB::connection('mysql')->select(" SELECT 
            t_inventario_dasimo.id_inventario_dasimo, 
            t_inventario_dasimo.nombre, 
            t_inventario_dasimo.cantidad - COALESCE(SUM(CASE WHEN t_inventario_solicitud.estatus = 'Prestado' THEN t_inventario_solicitud.cantidad ELSE 0 END), 0) AS Cantidad,
            t_inventario_dasimo.categoria, 
            t_inventario_dasimo.foto, 
            t_inventario_dasimo.fecha_creacion
        FROM 
            t_inventario_dasimo
        LEFT JOIN 
            t_inventario_solicitud 
        ON 
            t_inventario_dasimo.id_inventario_dasimo = t_inventario_solicitud.id_t_inventario_dasimo
        GROUP BY 
            t_inventario_dasimo.id_inventario_dasimo, 
            t_inventario_dasimo.nombre, 
            t_inventario_dasimo.cantidad, 
            t_inventario_dasimo.categoria, 
            t_inventario_dasimo.foto, 
            t_inventario_dasimo.fecha_creacion;");

        return view('Transmasivo.Dasimo.Solicitar_suministro',compact('inventario'));
    }
    public function post_Solicitar_suministro(Request $request)
    {
        $refacciones = json_decode($request->input('arreglo_pedidos'));
        //dd($refacciones);
        $folio=time();
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_una_hora_atras = $hora_actual - 0;
        $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);

        $html = view('Transmasivo.Almacen.pdf_prestamo_herramienta', compact('refacciones','folio','hora_formateada'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('Carta', 'landscape'); 
        $dompdf->render();

        DB::connection('mysql')->table('t_solicitud_inventario_dasimo')->insert([
            'cliente' => auth()->user()->id,
            'fecha' => $hora_formateada,
            'estatus' => 'Prestado',
        ]);
        $id =  DB::connection('mysql')
        ->table('t_solicitud_inventario_dasimo')
        ->where('fecha', $hora_formateada)
        ->value('id');
    
        for($i=0 ; $i< count($refacciones) ; $i++){
            DB::connection('mysql')->table('t_inventario_solicitud')->insert([
                'id_t_solicitud_inventario_dasimo' =>  $id,
                'id_t_inventario_dasimo' =>  $refacciones[$i]->id,
                'cantidad' => $refacciones[$i]->cantidad,
                'estatus' => 'Prestado'
            ]);
        }
        $pdfFileName = 'Prestamo_' . $folio . '.pdf';
        $pdfFilePath = public_path( $pdfFileName);

        file_put_contents($pdfFilePath, $dompdf->output());

        return redirect()->route('Solicitar_suministro')->with('pdf_url', asset( $pdfFileName));
    }
    
    public function Recepcion_suministro()
    {
        $consulta = DB::connection('mysql')->select('select t_solicitud_inventario_dasimo.*,users.name from  t_solicitud_inventario_dasimo
        INNER JOIN users on users.id=t_solicitud_inventario_dasimo.cliente
        WHERE t_solicitud_inventario_dasimo.estatus="Prestado"');
        return view('Transmasivo.Dasimo.Recepcion_suministro',compact('consulta'));
    }

    public function buscar_solicitud_suministro(Request $request)
    {
        $id = $request->input('id_solicitud_herramienta');
        
        return DB::connection('mysql')->select('select t_inventario_solicitud.*, t_inventario_dasimo.nombre, t_inventario_dasimo.foto from t_inventario_solicitud 
        INNER JOIN t_inventario_dasimo ON t_inventario_dasimo.id_inventario_dasimo=t_inventario_solicitud.id_t_inventario_dasimo 
        where t_inventario_solicitud.estatus="Prestado" and t_inventario_solicitud.id_t_solicitud_inventario_dasimo='.$id);
    }

    public function validar_cambio_solicitud_suministro_vida_util(Request $request)
    {
        $t_herramienta_solicitud = $request->input('t_herramienta_solicitud');
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_una_hora_atras = $hora_actual - 0;
        $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
        DB::table('t_inventario_solicitud')
        ->where('id', $t_herramienta_solicitud)
        ->update(['estatus' => 'Fin de vida util','quien_recibio'=> auth()->user()->id,'fecha_recibio'=> $hora_formateada]);

        $id_valida = DB::table('t_inventario_solicitud')
        ->where('id', $t_herramienta_solicitud)->get();
        

        $valida = DB::table('t_inventario_solicitud')
        ->where('id_t_solicitud_inventario_dasimo', $id_valida[0]->id_t_solicitud_inventario_dasimo)->where('estatus', 'Prestado')->get();
        
        if(count($valida)==0)
        {
            DB::table('t_solicitud_inventario_dasimo')
            ->where('id',  $id_valida[0]->id_t_solicitud_inventario_dasimo)
            ->update(['estatus' => 'Devuelto']);
            
            return 'termino';
        }
        else
        {
            return 'hola';
        }
    }
    public function validar_cambio_solicitud_suministro(Request $request)
    {
        
        //dd($request->all());
        $t_herramienta_solicitud = $request->input('t_herramienta_solicitud');
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_una_hora_atras = $hora_actual - 0;
        $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
        DB::table('t_inventario_solicitud')
        ->where('id', $t_herramienta_solicitud)
        ->update(['estatus' => 'Devuelto','quien_recibio'=> auth()->user()->id,'fecha_recibio'=> $hora_formateada]);

        $id_valida = DB::table('t_inventario_solicitud')
        ->where('id', $t_herramienta_solicitud)->get();
        

        $valida = DB::table('t_inventario_solicitud')
        ->where('id_t_solicitud_inventario_dasimo', $id_valida[0]->id_t_solicitud_inventario_dasimo)->where('estatus', 'Prestado')->get();
        
        if(count($valida)==0)
        {
            DB::table('t_solicitud_inventario_dasimo')
            ->where('id',  $id_valida[0]->id_t_solicitud_inventario_dasimo)
            ->update(['estatus' => 'Devuelto']);
            
            return 'termino';
        }
        else
        {
            return 'hola';
        }
        
    }

    public function Historial_solicitud_insumo()
    {
        $consulta = DB::connection('mysql')->select('select t_solicitud_inventario_dasimo.*,users.name from  t_solicitud_inventario_dasimo
        INNER JOIN users on users.id=t_solicitud_inventario_dasimo.cliente
        WHERE   users.id='.auth()->user()->id);
        //dd($consulta);
        return view('Transmasivo.Dasimo.Historial_solicitud_insumo',compact('consulta'));
    }

    public function post_Historial_solicitud_insumo(Request $request)
    {
        $id = $request->input('id_solicitud_herramienta');
        
        return DB::connection('mysql')->select('select t_inventario_solicitud.*, t_inventario_dasimo.nombre, t_inventario_dasimo.foto from t_inventario_solicitud 
        INNER JOIN t_inventario_dasimo ON t_inventario_dasimo.id_inventario_dasimo=t_inventario_solicitud.id_t_inventario_dasimo 
        where  t_inventario_solicitud.id_t_solicitud_inventario_dasimo='.$id);
    }
    
    
    
}