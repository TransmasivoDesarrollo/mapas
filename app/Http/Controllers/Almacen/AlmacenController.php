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
        $inventario=DB::connection('mysql')->select('select * from  t_caja_herramienta');
        return view('Transmasivo.Almacen.Solicitar_herramienta',compact('inventario'));
    }
    public function post_Solicitar_herramienta(Request $request)
    {
        $refacciones = json_decode($request->input('arreglo_pedidos'));
        //dd($refacciones);
        
        $folio=time();
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_una_hora_atras = $hora_actual - 0;
        $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);

        $html = view('Transmasivo.Almacen.pdf_prestamo_herramienta', compact('refacciones','folio'.'hora_formateada'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('Carta', 'landscape'); 
        $dompdf->render();

        // Generar un nombre único para el archivo PDF
        $pdfFileName = 'Prestamo_' . $folio . '.pdf';
        $pdfFilePath = public_path('pdf_caja_herramientas\\' . $pdfFileName);

        // Guardar el archivo PDF en el servidor
        file_put_contents($pdfFilePath, $dompdf->output());

        // Redirigir a la ruta y pasar la URL del PDF generado
        return redirect()->route('Solicitar_herramienta')->with('pdf_url', asset('pdf_caja_herramientas\\' . $pdfFileName));
    }

    
}