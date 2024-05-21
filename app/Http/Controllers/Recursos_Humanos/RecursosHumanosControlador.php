<?php

namespace App\Http\Controllers\Recursos_Humanos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory; 

class RecursosHumanosControlador extends Controller
{
    public function __construct()
	{

		$this->middleware(['auth']);
	}

    public function Alta_de_personal()
    {
        
        return view('Transmasivo.rh.alta_de_personal');
    }
    public function Contratos()
    {
        
        return view('Transmasivo.rh.Contratos');
    }
    public function generarContratos(Request $request)
    {
        //dd($request->all());
$user = auth()->user();

    // Puedes pasar otras variables necesarias aquí
    $data = [
        'user' => $user,
        'nombre' => $request->input('nombre'),
        'puesto' => $request->input('puesto'),
        'sueldo' => $request->input('sueldo'),
    ];
        // Renderizar la vista a HTML
    $html = View::make('Transmasivo.rh.contratoWord',$data)->render();

    // Crear un nuevo documento de Word
    $phpWord = new PhpWord();

    // Agregar el HTML al documento de Word
    \PhpOffice\PhpWord\Shared\Html::addHtml($phpWord->addSection(), $html);

    // Guardar el documento
    $filename = 'documento_word.docx';
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save(public_path($filename));

    // Descargar el documento
    return response()->download(public_path($filename))->deleteFileAfterSend(true);


    }
}
