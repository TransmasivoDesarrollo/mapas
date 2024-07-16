<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory; 
use App\Exports\InventarioExport;

class AlmacenController extends Controller
{
    public function __construct()
	{

		$this->middleware(['auth']);
	}

    public function Inventario_caja_herramienta()
    {
        return view('Transmasivo.Almacen.Inventario_caja_herramienta');
    }
    public function postInventario_caja_herramienta(Request $request)
    {
        $Refacción =$request->input('Refacción');
        $Cantidad =$request->input('Cantidad');
       
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
            $file->move(public_path().'/images/Caja de herramienta/',$NombreFinal);
        }
        

        DB::connection('mysql')->table('t_caja_herramienta')->insert([
            'Refaccion' => $Refacción,
            'Cantidad' => $Cantidad,
            'Foto' => $NombreFinal,
            'Fecha' => $hora_formateada
        ]);
        
        $mensaje="Se registro con exito!";
        $color="success";
        
        return redirect()->route('Inventario_caja_herramienta')->with('mensaje', $mensaje)->with('color', $color);
    }
    public function Contratos()
    {
        return view('Transmasivo.rh.Contratos');
    }
    public function Consultar_caja_herramienta()
    {
        $inventario=DB::connection('mysql')->select('select * from  t_caja_herramienta');
        //dd($inventario);
        return view('Transmasivo.Almacen.Consultar_caja_herramienta',compact('inventario'));
    }
    public function post_Consultar_caja_herramienta()
    {
        $inventario=DB::connection('mysql')->select('select * from  t_caja_herramienta');

        $mensaje="Se registro con exito!";
        $color="success";
        
       return Excel::download(new InventarioExport, 'inventario.xlsx');
    }
    
    public function Solicitar_herramienta()
    {
        $inventario=DB::connection('mysql')->select("SELECT 
            t_caja_herramienta.id, 
            t_caja_herramienta.Refaccion, 
            t_caja_herramienta.Cantidad - COALESCE(SUM(CASE WHEN t_herramienta_de_solicitud.estatus = 'Prestado' THEN t_herramienta_de_solicitud.cantidad ELSE 0 END), 0) AS Cantidad,
            t_caja_herramienta.Foto, 
            t_caja_herramienta.Fecha
        FROM 
            t_caja_herramienta
        LEFT JOIN 
            t_herramienta_de_solicitud 
        ON 
            t_caja_herramienta.id = t_herramienta_de_solicitud.id_t_caja_herramienta
        GROUP BY 
            t_caja_herramienta.id, 
            t_caja_herramienta.Refaccion, 
            t_caja_herramienta.Cantidad, 
            t_caja_herramienta.Foto, 
            t_caja_herramienta.Fecha;");
        return view('Transmasivo.Almacen.Solicitar_herramienta',compact('inventario'));
    }
    public function post_Solicitar_herramienta(Request $request)
    {
        $refacciones = json_decode($request->input('arreglo_pedidos'));
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

        DB::connection('mysql')->table('t_solicitud_herramienta')->insert([
            'Cliente' => auth()->user()->id,
            'Economico' => $request->input('unidad'),
            'Fecha' => $hora_formateada,
            'estatus' => 'Prestado',
        ]);
        $id = $id_solicitud_herramienta = DB::connection('mysql')
        ->table('t_solicitud_herramienta')
        ->where('Fecha', $hora_formateada)
        ->value('id_solicitud_herramienta');
    
        for($i=0 ; $i< count($refacciones) ; $i++){
            DB::connection('mysql')->table('t_herramienta_de_solicitud')->insert([
                'id_t_solicitud_herramienta' =>  $id,
                'id_t_caja_herramienta' =>  $refacciones[$i]->id,
                'cantidad' => $refacciones[$i]->cantidad,
                'estatus' => 'Prestado'
            ]);
        }
        $pdfFileName = 'Prestamo_' . $folio . '.pdf';
        $pdfFilePath = public_path( $pdfFileName);

        file_put_contents($pdfFilePath, $dompdf->output());

        return redirect()->route('Solicitar_herramienta')->with('pdf_url', asset( $pdfFileName));
    }
    public function Recepcion_herramienta()
    {
        $consulta = DB::connection('mysql')->select('select t_solicitud_herramienta.*,users.name from  t_solicitud_herramienta
        INNER JOIN users on users.id=t_solicitud_herramienta.Cliente
        WHERE t_solicitud_herramienta.estatus="Prestado"');
        return view('Transmasivo.Almacen.Recepcion_herramienta',compact('consulta'));
    }

    public function buscar_solicitud_herramienta(Request $request)
    {
        $id = $request->input('id_solicitud_herramienta');
        return DB::connection('mysql')->select('select t_herramienta_de_solicitud.*, t_caja_herramienta.Refaccion, t_caja_herramienta.Foto 
        from t_herramienta_de_solicitud
        INNER JOIN t_caja_herramienta ON t_caja_herramienta.id=t_herramienta_de_solicitud.id_t_caja_herramienta
        where t_herramienta_de_solicitud.estatus="Prestado" and t_herramienta_de_solicitud.id_t_solicitud_herramienta='.$id);
    }
    public function validar_cambio_solicitud_herramienta(Request $request)
    {
        //dd($request->all());
        $t_herramienta_solicitud = $request->input('t_herramienta_solicitud');

        DB::table('t_herramienta_de_solicitud')
        ->where('t_herramienta_solicituid', $t_herramienta_solicitud)
        ->update(['estatus' => 'Devuelto','quien_recibio'=> auth()->user()->id]);

        $id_valida = DB::table('t_herramienta_de_solicitud')
        ->where('t_herramienta_solicituid', $t_herramienta_solicitud)->get();
        
        $valida = DB::table('t_herramienta_de_solicitud')
        ->where('id_t_solicitud_herramienta', $id_valida[0]->id_t_solicitud_herramienta)->where('estatus', 'Prestado')->get();
        
        if(count($valida)==0)
        {
            $valida = DB::table('t_herramienta_de_solicitud')
        ->where('id_t_solicitud_herramienta', $id_valida[0]->id_t_solicitud_herramienta)->get();
           
            DB::table('t_solicitud_herramienta')
            ->where('id_solicitud_herramienta', $valida[0]->id_t_solicitud_herramienta)
            ->update(['estatus' => 'Devuelto']);
            
            return 'termino';
        }
        else
        {
            return 'hola';
        }
        

        
    }

    
}