<?php

namespace App\Http\Controllers\Recursos_Humanos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\TPersonal;
use App\Models\t_entrevista_salida;

use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory; 
use DateTime;
use geoPHP;

class RecursosHumanosControlador extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth']);
	}
    public function checkLocation(Request $request)
    {
        $lat = $request->input('latitude');
        $lon = $request->input('longitude');
        $polygon = [
            [-99.01161661797045, 19.61788033321528],
            [-99.00943866431281, 19.619103161356616],
            [-99.00789371196451, 19.617243650417787],
            [-99.01074758227455, 19.616455372984262],
            [-99.01161661797045, 19.61788033321528]
        ];

        if ($this->pointInPolygon($lat, $lon, $polygon)) {
            return response()->json(['status' => 'inside']);
        } else {
            return response()->json(['status' => 'outside']);
        }
    }

    private function pointInPolygon($lat, $lon, $polygon)
    {
        $point = [$lon, $lat];
        $inside = false;
        for ($i = 0, $j = count($polygon) - 1; $i < count($polygon); $j = $i++) {
            if ((($polygon[$i][1] > $point[1]) != ($polygon[$j][1] > $point[1])) &&
                ($point[0] < ($polygon[$j][0] - $polygon[$i][0]) * ($point[1] - $polygon[$i][1]) / ($polygon[$j][1] - $polygon[$i][1]) + $polygon[$i][0])) {
                $inside = !$inside;
            }
        }
        return $inside;
    }

    public function Alta_de_personal()
    {
        return view('Transmasivo.rh.alta_de_personal');
    }
    public function geo()
    {
        $eco_1000 = DB::connection('mysql')
        ->table('t_geolocalizacion_eco')
        ->where('economico', '=', 1000)
        ->latest('id_geolocalizacion')
        ->first();
    
  //  dd($eco_1000);
        $secciones = DB::connection('mysql')
        ->table('t_secciones-geolocalizacion')
        ->get();
        return view('Transmasivo.rh.geo',compact('eco_1000','secciones'));
    }
    public function geo2()
    {
        return view('Transmasivo.rh.geo2');
    }
    public function insertar_cordenadas(Request $request)
    {
        $cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');
        return 'si';
    }
    public function geo_eco1000()
    {
        return DB::connection('mysql')
        ->table('t_geolocalizacion_eco')
        ->where('economico', '=', 1000)
        ->latest('id_geolocalizacion')
        ->first();
    }
    
    
    public function Contratos()
    {
        return view('Transmasivo.rh.Contratos');
    }
    public function Renuncias()
    {
        $c_empresas = DB::connection('mysql')->table('c_empresa')->get();
        
        return view('Transmasivo.rh.Renuncias',compact('c_empresas'));
    }

    public function Encuesta_de_renuncia()
    {
        return view('Transmasivo.rh.Encuesta_de_renuncia');
    }
    public function estadisticas_renuncias()
    {
        $pregu3 = DB::connection('mysql')->select('SELECT relacion_jefe, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY relacion_jefe;');
        $pregu4 = DB::connection('mysql')->select('SELECT reconocimiento_jefe, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY reconocimiento_jefe;');
        $pregu5 = DB::connection('mysql')->select('SELECT reconocimiento_empresa, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY reconocimiento_empresa;');
        $pregu6 = DB::connection('mysql')->select('SELECT toma_decisiones, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY toma_decisiones;');
        $pregu7 = DB::connection('mysql')->select('SELECT importante_labor, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY importante_labor;');
        $pregu8 = DB::connection('mysql')->select('SELECT sueldo_parecio, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY sueldo_parecio;');
        $pregu9 = DB::connection('mysql')->select('SELECT crecimiento_laboral, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY crecimiento_laboral;');
        $pregu10 = DB::connection('mysql')->select('SELECT instrucciones_claras, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY instrucciones_claras;');
        $pregu11 = DB::connection('mysql')->select('SELECT carga_trabajo, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY carga_trabajo;');
        $pregu12 = DB::connection('mysql')->select('SELECT reuniones_trabajo, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY reuniones_trabajo;');
        $pregu13 = DB::connection('mysql')->select('SELECT aspiraciones_empresa, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY aspiraciones_empresa;');
        $pregu14 = DB::connection('mysql')->select('SELECT relaciones_personales_compañeros, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY relaciones_personales_compañeros;');
        $pregu15 = DB::connection('mysql')->select('SELECT responsabilidades_asumir, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY responsabilidades_asumir;');
        $pregu16 = DB::connection('mysql')->select('SELECT satisfecho_trabajo, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY satisfecho_trabajo;');
        $pregu17 = DB::connection('mysql')->select('SELECT cansado_falta_energia, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY cansado_falta_energia;');
        $pregu18 = DB::connection('mysql')->select('SELECT entusiasmo_perdido, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY entusiasmo_perdido;');
        $pregu19 = DB::connection('mysql')->select('SELECT perdida_apetito, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY perdida_apetito;');
        $pregu20 = DB::connection('mysql')->select('SELECT irritado, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY irritado;');
        $pregu21 = DB::connection('mysql')->select('SELECT faltas_al_mes, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY faltas_al_mes;');
        $pregu22 = DB::connection('mysql')->select('SELECT cursos_funciionales, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY cursos_funciionales;');
        $pregu23 = DB::connection('mysql')->select('SELECT baja_es, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY baja_es;');
        $pregu24 = DB::connection('mysql')->select('SELECT baja_motivo, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY baja_motivo;');
        $pregu25 = DB::connection('mysql')->select('SELECT volver_laborar, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY volver_laborar;');
        
        return view('Transmasivo.rh.estadisticas_renuncias',
            compact(
                'pregu3',
                'pregu4',
                'pregu5',
                'pregu6',
                'pregu7',
                'pregu8',
                'pregu9',
                'pregu10',
                'pregu11',
                'pregu12',
                'pregu13',
                'pregu14',
                'pregu15',
                'pregu16',
                'pregu17',
                'pregu18',
                'pregu19',
                'pregu20',
                'pregu21',
                'pregu22',
                'pregu23',
                'pregu24',
                'pregu25',
                ));
    }
    public function Encuesta_de_renuncia_guardar(Request $request)
    {
        
        $tiempo_años=$request->input('tiempo_año');
        $tiempo_años= $tiempo_años * 12;
        $tiempo_meses=$request->input('tiempo_meses');
        $tiempo_meses=$tiempo_meses + $tiempo_años;
        $personal = new t_entrevista_salida();
        $personal->id_entrevista_salida= $request->input('id_entrevista_salida');
        $personal->tiempo_laborado_meses= $tiempo_meses;
        $personal->horas_al_dia= $request->input('inicio');
        $personal->relacion_jefe= $request->input('relacion');
        $personal->reconocimiento_jefe= $request->input('reconocimiento_jefe');
        $personal->reconocimiento_empresa= $request->input('reconocimiento_empresa');
        $personal->toma_decisiones= $request->input('decisiones');
        $personal->importante_labor= $request->input('labor_desempeña');
        $personal->sueldo_parecio= $request->input('sueldo_parecio');
        $personal->crecimiento_laboral= $request->input('crecimiento_laboral');
        $personal->instrucciones_claras= $request->input('instrucciones_claras');
        $personal->carga_trabajo= $request->input('carga_trabajo');
        $personal->reuniones_trabajo= $request->input('juntas_reuniones');
        $personal->aspiraciones_empresa= $request->input('aspiraciones_personales');
        $personal->relaciones_personales_compañeros= $request->input('relaciones_personales');
        $personal->responsabilidades_asumir= $request->input('responsabilidad_asumir');
        $personal->satisfecho_trabajo= $request->input('terminar_dia');
        $personal->cansado_falta_energia= $request->input('cansado');
        $personal->entusiasmo_perdido= $request->input('entusiasmo');
        $personal->perdida_apetito= $request->input('apetito');
        $personal->irritado= $request->input('irritado');
        $personal->faltas_al_mes= $request->input('faltas_mes');
        $personal->cursos_funciionales= $request->input('capacitacion_funcionales');
        $personal->baja_es= $request->input('baja_es_por');
        $personal->baja_motivo= $request->input('motivo_renuncia');
        $personal->volver_laborar= $request->input('volverias_laborar');
        $personal->observaciones= $request->input('Observaciones');
        $personal->fecha= now();
        $personal->edad= $request->input('Edad');
        $personal->sexo= $request->input('Sexo');
        $personal->save();

        
        $mensaje="Gracias por concluir la encuesta!";
        $color="success";
       
       return redirect()->route('Encuesta_de_renuncia')->with('mensaje', $mensaje)->with('color', $color);
    }
    
    private function formatearFecha(DateTime $fecha)
    {
        $dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
        $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    
        $diaSemana = $dias[$fecha->format('w')];
        $dia = $fecha->format('d');
        $mes = $meses[$fecha->format('n') - 1];
        $anio = $fecha->format('Y');
    
        return "$diaSemana $dia de $mes del $anio";
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
