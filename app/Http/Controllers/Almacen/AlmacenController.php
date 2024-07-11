<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory; 

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
        

        DB::connection('mysql')->select('INSERT INTO t_caja_herramienta (Refaccion, Cantidad, Foto, Fecha) VALUES  ("'.$Refacción.'","'.$Cantidad.'","'.$NombreFinal.'","'.$hora_formateada.'");  ');
        
        $mensaje="Se registro con exito!";
        $color="success";
        
        return redirect()->route('Inventario_caja_herramienta')->with('mensaje', $mensaje)->with('color', $color);
    }
    public function Contratos()
    {
        

        return view('Transmasivo.rh.Contratos');
    }
    
}