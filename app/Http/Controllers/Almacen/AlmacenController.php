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
    public function Contratos()
    {
        

        return view('Transmasivo.rh.Contratos');
    }
    
}