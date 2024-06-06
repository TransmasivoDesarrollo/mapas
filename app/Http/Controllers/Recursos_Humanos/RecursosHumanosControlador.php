<?php

namespace App\Http\Controllers\Recursos_Humanos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\TPersonal;
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
        $id_operador = auth()->id();
        $user = auth()->user();
        $data = [
            'user' => $user,
            'nombre' => $request->input('nombre'),
            'Edad' => $request->input('Edad'),
            'Fecha_nacimiento' => $request->input('nacimiento'),
            'Sexo' => $request->input('Sexo'),
            'Civil' => $request->input('Civil'),
            'Calle' => $request->input('Calle'),
            'Numero' => $request->input('Numero'),
            'Colonia' => $request->input('Colonia'),
            'Alcaldia' => $request->input('Alcaldia'),
            'Estado' => $request->input('Estado'),
            'postal' => $request->input('postal'),
            'RFC' => $request->input('RFC'),
            'IMSS' => $request->input('IMSS'),
            'CURP' => $request->input('CURP'),
            'Correo' => $request->input('Correo'),
            'Puesto' => $request->input('Puesto'),
            'Nacionalidad' => $request->input('Nacionalidad'),
            'Salario_diario' => $request->input('Salario_diario'),
            'Salario_diario_letras' => $request->input('Salario_diario_letras'),
            'fecha_contrato' => $request->input('fecha_contrato_hidden'),
        ];
        $personal = new TPersonal();

        $personal->Nombre= $request->input('nombre');
        $personal->Edad= $request->input('Edad');
        $personal->Fecha_nacimiento= $request->input('nacimiento');
        $personal->Sexo= $request->input('Sexo');
        $personal->Estado_civil= $request->input('Civil');
        $personal->Calle= $request->input('Calle');
        $personal->Numero= $request->input('Numero');
        $personal->Colonia= $request->input('Colonia');
        $personal->Alcaldia_municipio= $request->input('Alcaldia');
        $personal->Estado= $request->input('Estado');
        $personal->Codigo_postal= $request->input('postal');
        $personal->RFC= $request->input('RFC');
        $personal->NSS= $request->input('IMSS');
        $personal->CURP= $request->input('CURP');
        $personal->Correo= $request->input('Correo');
        $personal->Puesto= $request->input('Puesto');
        $personal->Fecha_contrato= $request->input('fecha_contrato_hidden');
        $personal->Estatus= 'Activo';
        $personal->Fecha_real= now();
        $personal->id_operador = $id_operador;

        
        $personal->save();
    
        // Renderizar la vista a HTML
        $html = View::make('Transmasivo.rh.contratoWord', $data)->render();
    
        // Crear un nuevo documento de Word
        $phpWord = new PhpWord();
    
        // Configurar el tamaño de la página a carta (8.5 x 11 pulgadas)
        $section = $phpWord->addSection([
            'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(8.5),
            'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(11)
        ]);
    
        // Agregar el HTML al documento de Word
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
    
        // Guardar el documento
        $filename = 'Contrato '.$request->input('nombre').'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(public_path($filename));
    
        // Descargar el documento
        return response()->download(public_path($filename))->deleteFileAfterSend(true);
    }

    public function Personal()
    {
        $consulta= DB::connection('mysql')->select('select t_personal.*,users.name from t_personal left join users on t_personal.id_operador=users.id');
        return view('Transmasivo.rh.Personal',compact('consulta'));
    }
}
