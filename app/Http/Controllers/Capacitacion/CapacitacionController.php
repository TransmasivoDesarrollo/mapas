<?php

namespace App\Http\Controllers\Capacitacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory; 

class CapacitacionController extends Controller
{
    public function __construct()
	{

		$this->middleware(['auth']);
	}

    public function Agregar_capacitación()
    {
        return view('Transmasivo.Capacitacion.Agregar_capacitación');
    }

    public function post_Agregar_capacitación(Request $request)
    {
        $nombre = $request->input('Nombre_del_curso');
        $horas = $request->input('Cantidad');
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_formateada = date('Y-m-d H:i:s', $hora_actual);
        $user = auth()->user();
        $user = $user['id'];

        DB::connection('mysql')->table('t_curso_capacitacion')->insert([
            'curso' => $nombre,
            'horas' => $horas,
            'fecha_creacion' => $hora_formateada,
            'id_usuario_creacion' => $user,
        ]);
        
        $mensaje="Se registro con exito!";
        $color="success";
        
        return redirect()->route('Agregar_capacitación')->with('mensaje', $mensaje)->with('color', $color);
    }
    public function Agregar_personas_al_curso()
    {
        $c_cursos = DB::connection('mysql')->table('t_curso_capacitacion')->get();
        return view('Transmasivo.Capacitacion.Agregar_personas_al_curso',compact('c_cursos'));

    }

    public function post_Agregar_personas_al_curso(Request $request)
    {
        
        $Curso = $request->input('Curso');
        $participante = $request->input('participante');
        $area = $request->input('area');
        
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_formateada = date('Y-m-d H:i:s', $hora_actual);
        $user = auth()->user();
        $user = $user['id'];

        DB::connection('mysql')->table('t_inscripcion_capacitacion')->insert([
            'id_t_curso' => $Curso,
            'participante' => $participante,
            'area' => $area,
            'fecha_creacion' => $hora_formateada,
            'id_usuario_creacion' => $user,
        ]);
        
        $mensaje="Se registro con exito!";
        $color="success";
        
        return redirect()->route('Agregar_personas_al_curso')->with('mensaje', $mensaje)->with('color', $color);
    }

    public function Validar_horas_de_curso($consulta="" )
    {
        $c_cursos = DB::connection('mysql')->table('t_curso_capacitacion')->get();
        
        return view('Transmasivo.Capacitacion.Validar_horas_de_curso',compact('c_cursos','consulta'));

    }

    public function post_Validar_horas_de_curso(Request $request)
    {
        if($request->has('Buscar'))
        {
            
            
            $Curso = $request->input('Curso');

            $consulta = DB::connection('mysql')->select('select t_inscripcion_capacitacion.*, t_curso_capacitacion.* from t_inscripcion_capacitacion 
                inner join t_curso_capacitacion on t_curso_capacitacion.id_curso_capacitacion=t_inscripcion_capacitacion.id_t_curso
            where t_inscripcion_capacitacion. id_t_curso=? '
            ,[ $Curso ]
            );
            //dd($consulta);
            $c_cursos = DB::connection('mysql')->table('t_curso_capacitacion')->get();
            return view('Transmasivo.Capacitacion.Validar_horas_de_curso')->with('consulta', $consulta)->with('c_cursos', $c_cursos);
        }
        if($request->has('Comprobante'))
        {
            $id_inscripcion_capacitacion = $request->input('id_inscripcion_capacitacion');
            $consulta = DB::connection('mysql')->select('select t_inscripcion_capacitacion.*, t_curso_capacitacion.* from t_inscripcion_capacitacion 
                inner join t_curso_capacitacion on t_curso_capacitacion.id_curso_capacitacion=t_inscripcion_capacitacion.id_t_curso
            where t_inscripcion_capacitacion. id_inscripcion_capacitacion=? '
            ,[ $id_inscripcion_capacitacion ]
            );
          //  dd($consulta);
            $html = view('Transmasivo.Capacitacion.pdf_diploma',compact('consulta'))->render();
            $dompdf = new Dompdf();
            $dompdf->setPaper('Carta', 'landscape');
            $dompdf->loadHtml($html);
            $dompdf->render();
            return $dompdf->stream('pdf_diploma '.now().'.pdf');
        }
        if($request->has('boton_agregar'))
        {
            //dd($request->all());
            $id_inscripcion_capacitacion = $request->input('id_actualizar');
            $horas_tomadas = $request->input('horas_tomadas');

            $consulta = DB::connection('mysql')->select('update t_inscripcion_capacitacion set horas_tomadas = ? where id_inscripcion_capacitacion = ?'
            ,[ $horas_tomadas,$id_inscripcion_capacitacion ]
            );
          
            $c_cursos = DB::connection('mysql')->table('t_curso_capacitacion')->get();
            $consulta ="";
            return view('Transmasivo.Capacitacion.Validar_horas_de_curso')->with('c_cursos', $c_cursos)->with('consulta', $consulta);
        }
        if($request->has('boton_agregar_calificacion'))
        {
            //dd($request->all());
            $id_inscripcion_capacitacion = $request->input('id_actualizar2');
            $calificacion_tomadas = $request->input('calificacion_tomadas');

            $consulta = DB::connection('mysql')->select('update t_inscripcion_capacitacion set calificacion_final = ? where id_inscripcion_capacitacion = ?'
            ,[ $calificacion_tomadas,$id_inscripcion_capacitacion ]
            );
          
            $c_cursos = DB::connection('mysql')->table('t_curso_capacitacion')->get();
            $consulta ="";
            return view('Transmasivo.Capacitacion.Validar_horas_de_curso')->with('c_cursos', $c_cursos)->with('consulta', $consulta);
        }
        
        

        $Curso = $request->input('Curso');
        $participante = $request->input('participante');
        $area = $request->input('area');
        
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_formateada = date('Y-m-d H:i:s', $hora_actual);
        $user = auth()->user();
        $user = $user['id'];

        DB::connection('mysql')->table('t_inscripcion_capacitacion')->insert([
            'id_t_curso' => $Curso,
            'participante' => $participante,
            'area' => $area,
            'fecha_creacion' => $hora_formateada,
            'id_usuario_creacion' => $user,
        ]);
        
        $mensaje="Se registro con exito!";
        $color="success";
        
        return redirect()->route('Agregar_personas_al_curso')->with('mensaje', $mensaje)->with('color', $color);
    }

    
    
    
    
}