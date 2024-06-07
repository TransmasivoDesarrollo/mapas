<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory; 

class InventarioController extends Controller
{
    public function __construct()
	{

		$this->middleware(['auth']);
	}

    public function Inventario()
    {
        
        return view('Transmasivo.Inventario.nuevo_inventario');
    }
    public function ModificarInventario()
    {
        $t_inventarios=DB::connection('mysql')->select('SELECT t_inventario.*,users.name  from t_inventario 
        inner join  users on users.id=t_inventario.conto
        where t_inventario.Conto="'.auth()->user()->id .'"');
        return view('Transmasivo.Inventario.ModificarInventario',compact('t_inventarios'));
    }
    public function cambios(Request $request)
    {
        if(null !==$request->input('cambios'))
        {
            $codigo_m =$request->input('codigo_m');
            $refaccion_m =$request->input('refaccion_m');
            $cantidad_m =$request->input('cantidad_m');
            $Pasillo_m =$request->input('Pasillo_m');
            $Anaquel_m =$request->input('Anaquel_m');
            $Nivel_m =$request->input('Nivel_m');
            $Charola_m =$request->input('Charola_m');
            $id_inventario_m =$request->input('id_inventario_m');
            $Foto_mo =$request->file('Foto_mo');
            if($Foto_mo==null || $Foto_mo=='')
            {
                DB::connection('mysql')->update('
                UPDATE t_inventario 
                SET 
                    Codigo = ?, 
                    Refaccion = ?, 
                    Cantidad = ?, 
                    Pasillo = ?, 
                    Anaquel = ?, 
                    Nivel = ?, 
                    Charola = ?
                WHERE 
                    id_inventario = ?',
                [
                    $codigo_m, 
                    $refaccion_m, 
                    $cantidad_m, 
                    $Pasillo_m, 
                    $Anaquel_m, 
                    $Nivel_m, 
                    $Charola_m, 
                    $id_inventario_m // este es el id del inventario que deseas actualizar
                ]
            );
            }else{
                date_default_timezone_set('America/Mexico_City');
            $hora_actual = time();
            $hora_una_hora_atras = $hora_actual - 0;
            $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
            $hora_formateada2 = date('Y_m_d_H_i_s', $hora_una_hora_atras);
            $NombreFinal;
            
                $extension = $Foto_mo->getClientOriginalExtension();
                $NombreFinal = "_".$hora_formateada2.".".$extension;
                $Foto_mo->move(public_path().'/images/Inventario/',$NombreFinal);
        
            
                DB::connection('mysql')->update('
                UPDATE t_inventario 
                SET 
                    Codigo = ?, 
                    Refaccion = ?, 
                    Cantidad = ?, 
                    Pasillo = ?, 
                    Anaquel = ?, 
                    Nivel = ?, 
                    Charola = ?,
                    Foto = ?
                WHERE 
                    id_inventario = ?',
                [
                    $codigo_m, 
                    $refaccion_m, 
                    $cantidad_m, 
                    $Pasillo_m, 
                    $Anaquel_m, 
                    $Nivel_m, 
                    $Charola_m, 
                    $NombreFinal, 
                    $id_inventario_m // este es el id del inventario que deseas actualizar
                ]
            );
            }
           
    
    $mensaje="Se modifico con exito!";
    $color="success";
    
    return redirect()->route('ModificarInventario')->with('mensaje', $mensaje)->with('color', $color);
        }else if(null !==$request->input('pdf'))
        {

            $t_inventarios=DB::connection('mysql')->select('SELECT t_inventario.*,users.name  from t_inventario 
        inner join  users on users.id=t_inventario.conto
        where t_inventario.Conto="'.auth()->user()->id .'"');

            $html = view('Transmasivo.Inventario.pdf_inventario',compact('t_inventarios'))->render();
            $dompdf = new Dompdf();
            $dompdf->setPaper('Carta', 'landscape');
            $dompdf->loadHtml($html);
            $dompdf->render();
            return $dompdf->stream('inventario '.now().'.pdf');
        }
       
    }
    public function GuardarInventario(Request $request)
    {
        $codigo =$request->input('codigo');
        $refaccion =$request->input('refaccion');
        $cantidad =$request->input('cantidad');
        if($cantidad==null || $cantidad=="")
        {
            $cantidad=0;
        }
        $Pasillo =$request->input('Pasillo');
        if($Pasillo==null || $Pasillo=="")
        {
            $Pasillo=0;
        }
        $Anaquel =$request->input('Anaquel');
        if($Anaquel==null || $Anaquel=="")
        {
            $Anaquel=0;
        }
        $Nivel =$request->input('Nivel');
        if($Nivel==null || $Nivel=="")
        {
            $Nivel=0;
        }
        $Charola =$request->input('Charola');
        if($Charola==null || $Charola=="")
        {
            $Charola=0;
        }
        $file =$request->file('Foto');
        
      
        $Name =$request->input('Name');
        $id_name =$request->input('id_name');
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
            $NombreFinal = $id_name."_".$hora_formateada2.".".$extension;
            $file->move(public_path().'/images/Inventario/',$NombreFinal);
        }
        

        DB::connection('mysql')->select('INSERT INTO t_inventario (Codigo, Refaccion, Cantidad, Pasillo, Anaquel, Nivel, Charola, Foto, Conto, Fecha) VALUES 
        ("'.$codigo.'","'.$refaccion.'","'.$cantidad.'","'.$Pasillo.'","'.$Anaquel.'","'.$Nivel.'","'.$Charola.'","'.$NombreFinal.'","'.$id_name.'","'.$hora_formateada.'");  ');
        
        $mensaje="Se registro con exito!";
        $color="success";
        
        return redirect()->route('Inventario')->with('mensaje', $mensaje)->with('color', $color);
    }
   
}
