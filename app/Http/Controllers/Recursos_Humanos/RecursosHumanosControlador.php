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
        $personal->Nacionalidad= $request->input('Nacionalidad');
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
        $personal->Salario_diario= $request->input('Salario_diario');
        $personal->Fecha_contrato= $request->input('fecha_contrato_hidden');
        $personal->Fecha_contrato_date= $request->input('fecha_contrato');
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
    // Fetch the message and color from the session
    $mensaje = session('mensaje');
    $color = session('color');
    
    // Your database query
    $consulta = DB::connection('mysql')->select('select t_personal.*, users.name from t_personal left join users on t_personal.id_operador=users.id');
    
    // Pass variables to the view
    return view('Transmasivo.rh.Personal', compact('consulta', 'mensaje', 'color'));
}

    public function numberToWords($num)
        {
            $units = ["", "Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve"];
            $teens = ["Diez", "Once", "Doce", "Trece", "Catorce", "Quince", "Dieciséis", "Diecisiete", "Dieciocho", "Diecinueve"];
            $tens = ["", "", "Veinte", "Treinta", "Cuarenta", "Cincuenta", "Sesenta", "Setenta", "Ochenta", "Noventa"];
            $hundreds = ["", "Cien", "Doscientos", "Trescientos", "Cuatrocientos", "Quinientos", "Seiscientos", "Setecientos", "Ochocientos", "Novecientos"];

            if ($num == 0) return "Cero";

            $words = '';

            if ($num >= 1000) {
                $words .= "Mil ";
                $num %= 1000;
            }

            if ($num >= 100) {
                $words .= $hundreds[floor($num / 100)] . " ";
                $num %= 100;
            }

            if ($num >= 20) {
                $words .= $tens[floor($num / 10)] . " ";
                $num %= 10;
            } else if ($num >= 10) {
                $words .= $teens[$num - 10] . " ";
                $num = 0;
            }

            if ($num > 0) {
                $words .= $units[$num] . " ";
            }

            return strtoupper(trim($words));
        }
    public function accionParaPersonal(Request $request)
    {
        if($request->has('baja')){
            DB::connection('mysql')->table('t_personal')
            ->where('id_personal', $request->input('id_personal'))
            ->update(['estatus' => 'Baja']);
            $mensaje="El usuario se dio de baja con exito!";
            $color="success";
           
           return redirect()->route('Personal')->with('mensaje', $mensaje)->with('color', $color);
        }
        if($request->has('Reimprimir')){
            
            $personal = DB::connection('mysql')->select('select t_personal.*, users.name from t_personal inner join users on users.id=t_personal.id_operador where t_personal.id_personal='.$request->input('id_personal'));
            
            $id_operador = auth()->id();
            $user = auth()->user();
            $data = [
                'user' => $user,
                'nombre' =>$personal[0]->Nombre,
                'Edad' => $personal[0]->Edad ,
                'Fecha_nacimiento' =>$personal[0]->Fecha_nacimiento ,
                'Sexo' =>$personal[0]->Sexo ,
                'Civil' =>$personal[0]->Estado_civil ,
                'Calle' =>$personal[0]->Calle ,
                'Numero' =>$personal[0]->Numero ,
                'Colonia' =>$personal[0]->Colonia ,
                'Alcaldia' =>$personal[0]->Alcaldia_municipio ,
                'Estado' =>$personal[0]->Estado ,
                'postal' =>$personal[0]->Codigo_postal ,
                'RFC' =>$personal[0]->RFC ,
                'IMSS' =>$personal[0]->NSS ,
                'CURP' =>$personal[0]->CURP ,
                'Correo' =>$personal[0]->Correo ,
                'Puesto' =>$personal[0]->Puesto ,
                'Nacionalidad' =>$personal[0]->Nacionalidad ,
                'Salario_diario' =>$personal[0]->Salario_diario ,
                'Salario_diario_letras' => $this->numberToWords($personal[0]->Salario_diario) ,
                'fecha_contrato' =>$personal[0]->Fecha_contrato ,
            ];

            //dd($this->numberToWords($personal[0]->Salario_diario));
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
            $filename = 'Contrato '.$personal[0]->Nombre.'.docx';
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save(public_path($filename));
        
            // Descargar el documento
            return response()->download(public_path($filename))->deleteFileAfterSend(true);
            
        }
        if($request->has('Actualizar'))
        {
           // dd($request->input('id_personal_modal'));
            $id_operador = auth()->id();
            $user = auth()->user();
            $personal = TPersonal::find($request->input('id_personal_modal'));
            $personal->Nombre= $request->input('nombre');
            $personal->Edad= $request->input('Edad');
            $personal->Fecha_nacimiento= $request->input('nacimiento');
            $personal->Nacionalidad= $request->input('Nacionalidad');
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
            $personal->Salario_diario= $request->input('Salario_diario');
            $personal->Fecha_contrato= $request->input('fecha_contrato_hidden');
            $personal->Fecha_contrato_date= $request->input('fecha_contrato');
            $personal->Estatus= 'Activo';
            $personal->Fecha_real= now();
            $personal->id_operador = $id_operador;
            $personal->save();
            
            $mensaje="Se actualizo la información de ". $request->input('nombre')." con exito!";
            $color="success";
           
           return redirect()->route('Personal')->with('mensaje', $mensaje)->with('color', $color);


        }
    }
}
