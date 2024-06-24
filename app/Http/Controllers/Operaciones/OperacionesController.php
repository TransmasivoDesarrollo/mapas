<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\t_bitacora_terminales;
use App\Models\BitacoraLiberacionUnidades;
use DB;
use Dompdf\Dompdf;

use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth

class OperacionesController extends Controller
{
    

    public function Bitacora_de_operaciones()
    {
        $consulta = t_bitacora_terminales::whereBetween('fecha_registro', [now()->format('Y-m-d').' 00:00:00', now()->format('Y-m-d').' 23:59:00'])->get();

        
        $terminal = DB::connection('mysql_produc')->select('SELECT *from c_terminal');
        return view('Transmasivo.Operaciones.Bitacora_de_operaciones',compact('terminal','consulta'));
    }
    
    public function Registro_bitacora_terminal(Request $request)
    {
        if($request->has("pdf"))
        {
            $this->generarPDF();
        }else{
            $terminal=$request->input('terminal');
            $hora_llegada=$request->input('hora_llegada');
            $serv=$request->input('serv');
            $jorn=$request->input('jorn');
            $eco=$request->input('eco');
            $credencial=$request->input('credencial');
            $km=$request->input('km');
            $hora_salida=$request->input('hora_salida');
            $comentarios=$request->input('comentarios');

            date_default_timezone_set('America/Mexico_City');
            $hora_actual = time();

            $hora_una_hora_atras = $hora_actual - 3600;

            $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);

            $bitacora = new t_bitacora_terminales();
            $bitacora->terminal = $terminal;
            $bitacora->hora_llegada = $hora_llegada;
            $bitacora->Servicio = $serv; // Ajusta el nombre del campo según corresponda en tu tabla
            $bitacora->Jornada = $jorn; // Ajusta el nombre del campo según corresponda en tu tabla
            $bitacora->eco = $eco;
            $bitacora->credencial = $credencial;
            $bitacora->kilometraje = $km;
            $bitacora->hora_salida = $hora_salida;
            $bitacora->comentario = $comentarios;
            $bitacora->fecha_registro = $hora_formateada; // Fecha de registro actual
            $bitacora->id_usuario = Auth::id();
            
            // Guardar el registro en la base de datos
            $bitacora->save();
            
            $mensaje="Se registro con exito!";
            $color="success";
            return redirect()->route('Bitacora_de_operaciones')->with('mensaje', $mensaje)->with('color', $color);
        }
        
    }
    public function generarPDF()
    {
        $html = view('Transmasivo.Operaciones.reporte_bitacora_terminal')->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->stream('Bitacora de terminales .pdf');

    }

    public function Alta_de_reporte()
    {
        $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
        INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4)');
        $servicios = DB::connection('mysql_produc')->select('SELECT * from  cservicios WHERE idservicio IN(5,6,7,8)');
        $grupos = DB::connection('mysql_produc')->select('SELECT * from  cfallosgrales ');
        return view('Transmasivo.Operaciones.Alta_de_reporte',compact('unidades','servicios','grupos'));
    }
    public function catalogo_subgrupo(Request $request)
    {
        //return $request->all();
        return DB::connection('mysql_produc')->select('SELECT * FROM cdescfallo where falloGralfkcfallosgrales= '.$request->input("grupo_id"));
        
    }
    public function acciones(Request $request)
    {
        if(null !==$request->input('previo'))
        {
            $id=$request->input('id');
           // dd($id);
            $query = BitacoraLiberacionUnidades::query();
            $query->where('id_bitacora_liberacion_unidades', $id);
            
            $consulta_completa="SELECT 
            detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion,bitacora_liberacion_unidades.n_economico,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 5 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS Puertas__SERVICIO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 6 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS Puertas__EMERGENCIA,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 7 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO,
            
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 8 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 9 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 10 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 11 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 12 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 13 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 14 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BALATAS_EJE_DIRECCIONAL__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 15 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 16 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BALATAS_EJE_INTERMEDIO__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 17 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 18 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BALATAS_EJE_MOTRIZ__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 19 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 20 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 21 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 22 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 23 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 24 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 25 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS ASIENTOS__CONDUCTOR,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 26 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS ASIENTOS__CARRO_1,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 27 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS ASIENTOS__CARRO_2,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 28 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS CÓDIGO_EN_DISPLAY,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 29 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS ARTICULACION__ARTICULACION,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 30 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS ARTICULACION__SOPORTE,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 31 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS ARTICULACION__GRANADAS,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 32 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS CALIBRACION_DE_NEUMATICOS__GRANADAS,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 33 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS EJE_DIRECCIONAL__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 34 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS EJE_DIRECCIONAL__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 35 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS EJE_INTERMEDIO__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 36 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS EJE_INTERMEDIO__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 37 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS EJE_MOTRIZ__LADO_IZQUIERDO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 38 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS EJE_MOTRIZ__LADO_DERECHO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 39 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS SUSPENCION__EJE_1,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 40 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS SUSPENCION__EJE_2,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 41 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS SUSPENCION__EJE_3,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 42 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS TANQUE__DRENADO,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 46 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS TANQUE__CHICOTES,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 43 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS SOPORTES__MOTOR,
            GROUP_CONCAT(
                CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 44 THEN c_fallas_subseccion_liberacion_unidades.falla END
                ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
                SEPARATOR ', '
                ) AS SOPORTES__TRANSMISION
            
            
            FROM 
            detalle_falla_bitacora_liberacion_unidades
            INNER JOIN 
            c_fallas_subseccion_liberacion_unidades ON c_fallas_subseccion_liberacion_unidades.id_fallas_subseccion_liberacion_unidades = detalle_falla_bitacora_liberacion_unidades.id_c_fallas INNER JOIN 
            bitacora_liberacion_unidades ON detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion = bitacora_liberacion_unidades.id_bitacora_liberacion_unidades
        
            WHERE  bitacora_liberacion_unidades.id_bitacora_liberacion_unidades='".$id ."' ";
             $consulta_completa.=" GROUP BY 
     
             bitacora_liberacion_unidades.n_economico,
             detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion; ";
             $query = BitacoraLiberacionUnidades::query();
             $query->where('id_bitacora_liberacion_unidades', $id);
             $consulta = $query->get();
            $consulta_fallas = DB::connection('mysql')->select($consulta_completa);
            
            //dd( $consulta_fallas);
            $res = $consulta;
                 $userAttributes = $consulta->map(function ($consult) {
                    return $consult->attributesToArray();
                });
                 
                 
                // dd($userAttributes->toArray());
                 $res2=$userAttributes->toArray();
            $i=0;
    
            foreach ($res2 as &$elemento) {
                
                $claves = array_keys($elemento);
                $indice = array_search('servicio', $claves);
                $emergencia = array_search('emergencia', $claves);
                $neu_eje_dir_izq = array_search('neu_eje_dir_izq', $claves);
                $neu_eje_dir_der = array_search('neu_eje_dir_der', $claves);
                $neu_eje_int_izq = array_search('neu_eje_int_izq', $claves);
                $neu_eje_int_der = array_search('neu_eje_int_der', $claves);
                $neu_eje_motr_izq = array_search('neu_eje_motr_izq', $claves);
                $neu_eje_motr_der = array_search('neu_eje_motr_der', $claves);
                $bal_eje_dir_izq = array_search('bal_eje_dir_izq', $claves);
                $bal_eje_dir_der = array_search('bal_eje_dir_der', $claves);
                $bal_eje_int_izq = array_search('bal_eje_int_izq', $claves);
                $bal_eje_int_der = array_search('bal_eje_int_der', $claves);
                $bal_eje_motr_izq = array_search('bal_eje_motr_izq', $claves);
                $bal_eje_motr_der = array_search('bal_eje_motr_der', $claves);
                $bols_air_eje_dir_izq = array_search('bols_air_eje_dir_izq', $claves);
                $bols_air_eje_dir_der = array_search('bols_air_eje_dir_der', $claves);
                $bols_air_eje_int_izq = array_search('bols_air_eje_int_izq', $claves);
                $bols_air_eje_int_der = array_search('bols_air_eje_int_der', $claves);
                $bols_air_eje_motr_izq = array_search('bols_air_eje_motr_izq', $claves);
                $bols_air_eje_motr_der = array_search('bols_air_eje_motr_der', $claves);
                $asiento_conductor = array_search('asiento_conductor', $claves);
                $asiento_carro1 = array_search('asiento_carro1', $claves);
                $asiento_carro2 = array_search('asiento_carro2', $claves);
                $articulacion = array_search('articulacion', $claves);
                $articulacion_soporte = array_search('articulacion_soporte', $claves);
                $articulacion_granada = array_search('articulacion_granada', $claves);
                $calibracion_neum_granada = array_search('calibracion_neum_granada', $claves);
                $eje_dir_izq = array_search('eje_dir_izq', $claves);
                $eje_dir_der = array_search('eje_dir_der', $claves);
                $eje_inter_izq = array_search('eje_inter_izq', $claves);
                $eje_inter_der = array_search('eje_inter_der', $claves);
                $eje_motr_izq = array_search('eje_motr_izq', $claves);
                $eje_motr_der = array_search('eje_motr_der', $claves);
                $susp_eje1 = array_search('susp_eje1', $claves);
                $susp_eje2 = array_search('susp_eje2', $claves);
                $susp_eje3 = array_search('susp_eje3', $claves);
                $tan_drenado = array_search('tan_drenado', $claves);
                $tan_chicote = array_search('tan_chicote', $claves);
                $soport_motor = array_search('soport_motor', $claves);
                $soport_transmi = array_search('soport_transmi', $claves);
                
                if ($indice !== false) {
                    $nuevas_columnas = ['servicio_fallas' => $consulta_fallas[$i]->Puertas__SERVICIO,];
                    $elemento = array_merge(array_slice($elemento, 0, $indice + 1),$nuevas_columnas,array_slice($elemento, $indice + 1));
                }
                if ($emergencia !== false) { $nuevas_columnas = ['emergencia_fallas' => $consulta_fallas[$i]->Puertas__EMERGENCIA,];
                $elemento = array_merge(array_slice($elemento, 0, $emergencia + 2),$nuevas_columnas,array_slice($elemento, $emergencia + 1) );
            }
            if ($neu_eje_dir_izq !== false) { $nuevas_columnas = ['neu_eje_dir_izq_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $neu_eje_dir_izq + 3),$nuevas_columnas,array_slice($elemento, $neu_eje_dir_izq + 1) );
        }
            if ($neu_eje_dir_der !== false) { $nuevas_columnas = ['neu_eje_dir_der_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $neu_eje_dir_der + 4),$nuevas_columnas,array_slice($elemento, $neu_eje_dir_der + 1) );
            }
            if ($neu_eje_int_izq !== false) { $nuevas_columnas = ['neu_eje_int_izq_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $neu_eje_int_izq + 5),$nuevas_columnas,array_slice($elemento, $neu_eje_int_izq + 1) );
            }
            if ($neu_eje_int_der !== false) { $nuevas_columnas = ['neu_eje_int_der_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $neu_eje_int_der + 6),$nuevas_columnas,array_slice($elemento, $neu_eje_int_der + 1) );
            }
            if ($neu_eje_motr_izq !== false) { $nuevas_columnas = ['neu_eje_motr_izq_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $neu_eje_motr_izq + 7),$nuevas_columnas,array_slice($elemento, $neu_eje_motr_izq + 1) );
            }
            if ($neu_eje_motr_der !== false) { $nuevas_columnas = ['neu_eje_motr_der_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $neu_eje_motr_der + 8),$nuevas_columnas,array_slice($elemento, $neu_eje_motr_der + 1) );
            }
            if ($bal_eje_dir_izq !== false) { $nuevas_columnas = ['bal_eje_dir_izq_fallas' => $consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $bal_eje_dir_izq + 9),$nuevas_columnas,array_slice($elemento, $bal_eje_dir_izq + 1) );
            }
            if ($bal_eje_dir_der !== false) { $nuevas_columnas = ['bal_eje_dir_der_fallas' => $consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $bal_eje_dir_der + 10),$nuevas_columnas,array_slice($elemento, $bal_eje_dir_der + 1) );
            }
            if ($bal_eje_int_izq !== false) { $nuevas_columnas = ['bal_eje_int_izq_fallas' => $consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $bal_eje_int_izq + 11),$nuevas_columnas,array_slice($elemento, $bal_eje_int_izq + 1) );
            }
            if ($bal_eje_int_der !== false) { $nuevas_columnas = ['bal_eje_int_der_fallas' => $consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $bal_eje_int_der + 12),$nuevas_columnas,array_slice($elemento, $bal_eje_int_der + 1) );
            }
            if ($bal_eje_motr_izq !== false) { $nuevas_columnas = ['bal_eje_motr_izq_fallas' => $consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $bal_eje_motr_izq + 13),$nuevas_columnas,array_slice($elemento, $bal_eje_motr_izq + 1) );
            }
            if ($bal_eje_motr_der !== false) { $nuevas_columnas = ['bal_eje_motr_der_fallas' => $consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $bal_eje_motr_der + 14),$nuevas_columnas,array_slice($elemento, $bal_eje_motr_der + 1) );
            }
            if ($bols_air_eje_dir_izq !== false) { $nuevas_columnas = ['bols_air_eje_dir_izq_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_dir_izq + 15),$nuevas_columnas,array_slice($elemento, $bols_air_eje_dir_izq + 1) );
            }
            if ($bols_air_eje_dir_der !== false) { $nuevas_columnas = ['bols_air_eje_dir_der_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_dir_der + 16),$nuevas_columnas,array_slice($elemento, $bols_air_eje_dir_der + 1) );
            }
            if ($bols_air_eje_int_izq !== false) { $nuevas_columnas = ['bols_air_eje_int_izq_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_int_izq + 17),$nuevas_columnas,array_slice($elemento, $bols_air_eje_int_izq + 1) );
            }
            if ($bols_air_eje_int_der !== false) { $nuevas_columnas = ['bols_air_eje_int_der_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_int_der + 18),$nuevas_columnas,array_slice($elemento, $bols_air_eje_int_der + 1) );
            }
            if ($bols_air_eje_motr_izq !== false) { $nuevas_columnas = ['bols_air_eje_motr_izq_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_motr_izq + 19),$nuevas_columnas,array_slice($elemento, $bols_air_eje_motr_izq + 1) );
            }
            if ($bols_air_eje_motr_der !== false) { $nuevas_columnas = ['bols_air_eje_motr_der_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_motr_der + 20),$nuevas_columnas,array_slice($elemento, $bols_air_eje_motr_der + 1) );
            }
            if ($asiento_conductor !== false) { $nuevas_columnas = ['asiento_conductor_fallas' => $consulta_fallas[$i]->ASIENTOS__CONDUCTOR,];
            $elemento = array_merge(array_slice($elemento, 0, $asiento_conductor + 21),$nuevas_columnas,array_slice($elemento, $asiento_conductor + 1) );
            }
            if ($asiento_carro1 !== false) { $nuevas_columnas = ['asiento_carro1_fallas' => $consulta_fallas[$i]->ASIENTOS__CARRO_1,];
            $elemento = array_merge(array_slice($elemento, 0, $asiento_carro1 + 22),$nuevas_columnas,array_slice($elemento, $asiento_carro1 + 1) );
            }
            if ($asiento_carro2 !== false) { $nuevas_columnas = ['asiento_carro2_fallas' => $consulta_fallas[$i]->ASIENTOS__CARRO_2,];
            $elemento = array_merge(array_slice($elemento, 0, $asiento_carro2 + 23),$nuevas_columnas,array_slice($elemento, $asiento_carro2 + 1) );
            }
            if ($articulacion !== false) { $nuevas_columnas = ['articulacion_fallas' => $consulta_fallas[$i]->ARTICULACION__ARTICULACION,];
            $elemento = array_merge(array_slice($elemento, 0, $articulacion + 24),$nuevas_columnas,array_slice($elemento, $articulacion + 1) );
            }
            if ($articulacion_soporte !== false) { $nuevas_columnas = ['articulacion_soporte_fallas' => $consulta_fallas[$i]->ARTICULACION__SOPORTE,];
            $elemento = array_merge(array_slice($elemento, 0, $articulacion_soporte + 25),$nuevas_columnas,array_slice($elemento, $articulacion_soporte + 1) );
            }
            if ($articulacion_granada !== false) { $nuevas_columnas = ['articulacion_granada_fallas' => $consulta_fallas[$i]->ARTICULACION__GRANADAS,];
            $elemento = array_merge(array_slice($elemento, 0, $articulacion_granada + 26),$nuevas_columnas,array_slice($elemento, $articulacion_granada + 1) );
            }
            if ($calibracion_neum_granada !== false) { $nuevas_columnas = ['calibracion_neum_granada_fallas' => $consulta_fallas[$i]->CALIBRACION_DE_NEUMATICOS__GRANADAS,];
            $elemento = array_merge(array_slice($elemento, 0, $calibracion_neum_granada + 27),$nuevas_columnas,array_slice($elemento, $calibracion_neum_granada + 1) );
            }
            if ($eje_dir_izq !== false) { $nuevas_columnas = ['eje_dir_izq_fallas' => $consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $eje_dir_izq + 28),$nuevas_columnas,array_slice($elemento, $eje_dir_izq + 1) );
            }
            if ($eje_dir_der !== false) { $nuevas_columnas = ['eje_dir_der_fallas' => $consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $eje_dir_der + 29),$nuevas_columnas,array_slice($elemento, $eje_dir_der + 1) );
            }
            if ($eje_inter_izq !== false) { $nuevas_columnas = ['eje_inter_izq_fallas' => $consulta_fallas[$i]->EJE_INTERMEDIO__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $eje_inter_izq + 30),$nuevas_columnas,array_slice($elemento, $eje_inter_izq + 1) );
            }
            if ($eje_inter_der !== false) { $nuevas_columnas = ['eje_inter_der_fallas' => $consulta_fallas[$i]->EJE_INTERMEDIO__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $eje_inter_der + 31),$nuevas_columnas,array_slice($elemento, $eje_inter_der + 1) );
            }
            if ($eje_motr_izq !== false) { $nuevas_columnas = ['eje_motr_izq_fallas' => $consulta_fallas[$i]->EJE_MOTRIZ__LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $eje_motr_izq + 32),$nuevas_columnas,array_slice($elemento, $eje_motr_izq + 1) );
            }
            if ($eje_motr_der !== false) { $nuevas_columnas = ['eje_motr_der_fallas' => $consulta_fallas[$i]->EJE_MOTRIZ__LADO_DERECHO,];
            $elemento = array_merge(array_slice($elemento, 0, $eje_motr_der + 33),$nuevas_columnas,array_slice($elemento, $eje_motr_der + 1) );
            }
            if ($susp_eje1 !== false) { $nuevas_columnas = ['susp_eje1_fallas' => $consulta_fallas[$i]->SUSPENCION__EJE_1,];
            $elemento = array_merge(array_slice($elemento, 0, $susp_eje1 + 34),$nuevas_columnas,array_slice($elemento, $susp_eje1 + 1) );
            }
            if ($susp_eje2 !== false) { $nuevas_columnas = ['susp_eje2_fallas' => $consulta_fallas[$i]->SUSPENCION__EJE_2,];
            $elemento = array_merge(array_slice($elemento, 0, $susp_eje2 + 35),$nuevas_columnas,array_slice($elemento, $susp_eje2 + 1) );
            }
            if ($susp_eje3 !== false) { $nuevas_columnas = ['susp_eje3_fallas' => $consulta_fallas[$i]->SUSPENCION__EJE_3,];
            $elemento = array_merge(array_slice($elemento, 0, $susp_eje3 + 36),$nuevas_columnas,array_slice($elemento, $susp_eje3 + 1) );
            }
            if ($tan_drenado !== false) { $nuevas_columnas = ['tan_drenado_fallas' => $consulta_fallas[$i]->TANQUE__DRENADO,];
            $elemento = array_merge(array_slice($elemento, 0, $tan_drenado + 37),$nuevas_columnas,array_slice($elemento, $tan_drenado + 1) );
            }
            if ($tan_chicote !== false) { $nuevas_columnas = ['tan_chicote_fallas' => $consulta_fallas[$i]->TANQUE__CHICOTES,];
            $elemento = array_merge(array_slice($elemento, 0, $tan_chicote + 38),$nuevas_columnas,array_slice($elemento, $tan_chicote + 1) );
            }
            if ($soport_motor !== false) { $nuevas_columnas = ['soport_motor_fallas' => $consulta_fallas[$i]->SOPORTES__MOTOR,];
            $elemento = array_merge(array_slice($elemento, 0, $soport_motor + 39),$nuevas_columnas,array_slice($elemento, $soport_motor + 1) );
            }
            if ($soport_transmi !== false) { $nuevas_columnas = ['soport_transmi_fallas' => $consulta_fallas[$i]->SOPORTES__TRANSMISION,];
            $elemento = array_merge(array_slice($elemento, 0, $soport_transmi + 40),$nuevas_columnas,array_slice($elemento, $soport_transmi + 1) );
            }
            $i++;
            }
                    //dd($res);
                    // Obtener las columnas que terminan en "_o"
        $columns_o = [
            'aceite_motor_o',
            'refrigerante_o',
            'aceite_hidra_o',
            'hidroven_o',
            'servicio_o',
            'emergencia_o',
            'neu_eje_dir_izq_o',
            'neu_eje_dir_der_o',
            'neu_eje_int_izq_o',
            'neu_eje_int_der_o',
            'neu_eje_motr_izq_o',
            'neu_eje_motr_der_o',
            'bal_eje_dir_izq_o',
            'bal_eje_dir_der_o',
            'bal_eje_int_izq_o',
            'bal_eje_int_der_o',
            'bal_eje_motr_izq_o',
            'bal_eje_motr_der_o',
            'bols_air_eje_dir_izq_o',
            'bols_air_eje_dir_der_o',
            'bols_air_eje_int_izq_o',
            'bols_air_eje_int_der_o',
            'bols_air_eje_motr_izq_o',
            'bols_air_eje_motr_der_o',
            'asiento_conductor_o',
            'asiento_carro1_o',
            'asiento_carro2_o',
            'pasamanos_carro1_o',
            'pasamanos_carro2_o',
            'codigo_display_o',
            'articulacion_o',
            'articulacion_soporte_o',
            'articulacion_granada_o',
            'calibracion_neum_granada_o',
            'eje_dir_izq_o',
            'eje_dir_der_o',
            'eje_inter_izq_o',
            'eje_inter_der_o',
            'eje_motr_izq_o',
            'eje_motr_der_o',
            'susp_eje1_o',
            'susp_eje2_o',
            'susp_eje3_o',
            'tan_drenado_o',
            'tan_chicote_o',
            
            'soport_motor_o',
            'soport_transmi_o',
        ];
        $columns_not_o = [
            'aceite_motor',
            'aceite_motor_lt',
            'refrigerante',
            'refrigerante_lt',
            'aceite_hidra',
            'aceite_hidra_lt',
            'hidroven',
            'hidroven_lt',
            'servicio',
            'servicio_fallas',
            'emergencia',
            'emergencia_fallas',
            'neu_eje_dir_izq',
            'neu_eje_dir_izq_fallas',
            'neu_eje_dir_der',
            'neu_eje_dir_der_fallas',
            'neu_eje_int_izq',
            'neu_eje_int_izq_fallas',
            'neu_eje_int_der',
            'neu_eje_int_der_fallas',
            'neu_eje_motr_izq',
            'neu_eje_motr_izq_fallas',
            'neu_eje_motr_der',
            'neu_eje_motr_der_fallas',
            'bal_eje_dir_izq',
            'bal_eje_dir_izq_fallas',
            'bal_eje_dir_der',
            'bal_eje_dir_der_fallas',
            'bal_eje_int_izq',
            'bal_eje_int_izq_fallas',
            'bal_eje_int_der',
            'bal_eje_int_der_fallas',
            'bal_eje_motr_izq',
            'bal_eje_motr_izq_fallas',
            'bal_eje_motr_der',
            'bal_eje_motr_der_fallas',
            'bols_air_eje_dir_izq',
            'bols_air_eje_dir_izq_fallas',
            'bols_air_eje_dir_der',
            'bols_air_eje_dir_der_fallas',
            'bols_air_eje_int_izq',
            'bols_air_eje_int_izq_fallas',
            'bols_air_eje_int_der',
            'bols_air_eje_int_der_fallas',
            'bols_air_eje_motr_izq',
            'bols_air_eje_motr_izq_fallas',
            'bols_air_eje_motr_der',
            'bols_air_eje_motr_der_fallas',
            'asiento_conductor',
            'asiento_conductor_fallas',
            'asiento_carro1',
            'asiento_carro1_fallas',
            'asiento_carro2',
            'asiento_carro2_fallas',
            'pasamanos_carro1',
            'pasamanos_carro1_fallas',
            'pasamanos_carro2',
            'pasamanos_carro2_fallas',
            'articulacion',
            'articulacion_fallas',
            'articulacion_soporte',
            'articulacion_soporte_fallas',
            'articulacion_granada',
            'articulacion_granada_fallas',
            'calibracion_neum_granada',
            'calibracion_neum_granada_fallas',
            'eje_dir_izq',
            'eje_dir_izq_fallas',
            'eje_dir_der',
            'eje_dir_der_fallas',
            'eje_inter_izq',
            'eje_inter_izq_fallas',
            'eje_inter_der',
            'eje_inter_der_fallas',
            'eje_motr_izq',
            'eje_motr_izq_fallas',
            'eje_motr_der',
            'eje_motr_der_fallas',
            'susp_eje1',
            'susp_eje1_fallas',
            'susp_eje2',
            'susp_eje2_fallas',
            'susp_eje3',
            'susp_eje3_fallas',
            'tan_drenado',
            'tan_drenado_fallas',
            'tan_chicote',
            'tan_chicote_fallas',
            
            'soport_motor',
            'soport_motor_fallas',
            'soport_transmi',
            'soport_transmi_fallas',
        ];
        
                        // Iterar sobre cada fila del resultado
        foreach ($res as &$row) {
                        // Iterar sobre cada columna terminada en "_o"
            foreach ($columns_o as $column_o) {
                            // Verificar si la columna está vacía o nula
                if (empty($row[$column_o]) && !is_numeric($row[$column_o])) {
                                // Cambiar el valor por "sin observaciones"
                    $row[$column_o] = "S/O";
                }
            }
        }
                    //dd($res);
        $html = view('Transmasivo.Operaciones.reporte_bitacora_terminal',compact('res'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->stream('Autorización de economicos '.now().'.pdf');
        }
        if(null !==$request->input('Aprobar'))
        {
        
            DB::connection('mysql')->table('bitacora_liberacion_unidades')
                ->where('id_bitacora_liberacion_unidades', $request->input('id'))
                ->update(['estatus' => $request->input('Aprobar')]);
               return $this->Autorizacion_check_mantenimiento('Se aprobo con exito!!','success');
        }
        if(null !==$request->input('Rechazar'))
        {
            DB::connection('mysql')->table('bitacora_liberacion_unidades')
            ->where('id_bitacora_liberacion_unidades', $request->input('id'))
            ->update(['estatus' => $request->input('Rechazar')]);
           return $this->Autorizacion_check_mantenimiento('Se rechazo con exito','success');
        }
        if(null !==$request->input('pendientes'))
        {
            DB::connection('mysql')->table('bitacora_liberacion_unidades')
            ->where('id_bitacora_liberacion_unidades', $request->input('id'))
            ->update(['estatus' => $request->input('pendientes')]);
           return $this->Autorizacion_check_mantenimiento('Se aprobo con exito, con pendiente menor','info');
        }
    }
    public function bannerModulo200($mensaje="", $color="")
    {
        return view('Transmasivo.Operaciones.bannerModulo200',compact('mensaje','color'));
   
    }
    public function subirBannerOperaciones(Request $request)
    {
        
        $file =$request->file('uploadImg');
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_una_hora_atras = $hora_actual - 0;
        $hora_formateada2 = date('Y_m_d_H_i_s', $hora_una_hora_atras);
        $extension = $file->getClientOriginalExtension();
        $NombreFinal =  auth()->user()->id ."_".$hora_formateada2.".".$extension;
        $file->move(public_path().'/images/Operaciones/',$NombreFinal);

        $pantalla= $request->input('pantalla');
        $ultimo = DB::connection('mysql')->select('SELECT id
        FROM banner200 
        ORDER BY id DESC 
        LIMIT 1;');
        $masuno=$ultimo[0]->id;
        $masuno=$masuno + 1;

        DB::connection('mysql')->table('banner200')->insert([
            'imagen' => $NombreFinal,
            'pantalla' => $pantalla,
            'estatus' => 'Activo',
            'orden' => $masuno
        ]);
        
        return $this->bannerModulo200('Se subio la imagen correctamente!','success');
    }
    public function m200()
    {
        $images = DB::connection('mysql')->select('SELECT * 
        FROM banner200 
        WHERE estatus="Activo"
        ORDER BY  orden ASC,
          CASE 
            WHEN RIGHT(imagen, 3) = "mp4" THEN 1 
            ELSE 0 
          END, 
          imagen; ');
        return view('Transmasivo.Operaciones.200',compact('images'));
    }

    public function modificar_banner_200($mensaje="",$color="")
    {
       
        $images = DB::connection('mysql')->select('SELECT * FROM banner200 WHERE estatus IN ("Activo", "Inactivo") ORDER BY estatus ASC, orden ASC;      ');
        $cuenta = DB::connection('mysql')->select('SELECT count(*) as cuenta FROM banner200 where estatus in ("Activo") ');
        //dd($cuenta);
        return view('Transmasivo.Operaciones.modificar_banner_200',compact('images','mensaje','color','cuenta'));
    }
    public function cambiar_estatus_banner_200(Request $request)
    {
        if($request->has('cambiar_segundos')){
            DB::connection('mysql')->table('banner200')
            ->where('id', $request->input('id2'))
            ->update(['pantalla' => $request->input('pantalla')]);
            
            return $this->modificar_banner_200('Se actualizo los segundos correctamente!','success');
        }else if($request->has('Desactivar')){
            DB::connection('mysql')->table('banner200')
            ->where('id', $request->input('id'))
            ->update(['estatus' => 'Inactivo']);
            
            return $this->modificar_banner_200('Se actualizo el estatus correctamente!','success');
        }else if($request->has('Eliminar')){
            DB::connection('mysql')->table('banner200')
            ->where('id', $request->input('id'))
            ->update(['estatus' => 'Eliminar']);
            
            return $this->modificar_banner_200('Se actualizo el estatus correctamente!','success');
        }else if($request->has('Activo')){
            DB::connection('mysql')->table('banner200')
            ->where('id', $request->input('id'))
            ->update(['estatus' => 'Activo']);
            
            return $this->modificar_banner_200('Se actualizo el estatus correctamente!','success');
        }
        else if($request->has('Bajar')){
            $actual=$request->input('orden_subir_bajar');
            $actual_menos= $actual ;
            $contador= DB::connection('mysql')->table('banner200')->get();
           // dd(count($contador));
            $consultar="";
            for ($i = 0;count($contador)>$i;$i++) {

                $actual_menos= $actual_menos + 1;
                $consultar= DB::connection('mysql')->table('banner200')->where('orden', $actual_menos)->get();
                //dd($consultar[0]->estatus);
                if($consultar[0]->estatus == 'Activo'){
                    //dd($i);
                    break;
                }
            } 
            //dd($consultar);
            DB::connection('mysql')->table('banner200')
            ->where('id', $request->input('id_subir_bajar'))
            ->update(['orden' => $consultar[0]->orden]);

            DB::connection('mysql')->table('banner200')
            ->where('id', $consultar[0]->id)
            ->update(['orden' => $request->input('orden_subir_bajar')]);
            
            
            return redirect()->route('modificar_banner_200')->with('mensaje', 'Se actualizo el orden correctamente!')->with('color', 'success');
        }
        else if($request->has('Subir')){
            $actual=$request->input('orden_subir_bajar');
            $actual_menos= $actual ;
            $contador= DB::connection('mysql')->table('banner200')->get();
           // dd(count($contador));
            $consultar="";
            for ($i = 0;count($contador)>$i;$i++) {

                $actual_menos= $actual_menos -1 ;
                $consultar= DB::connection('mysql')->table('banner200')->where('orden', $actual_menos)->get();
                //dd($consultar[0]);
                if($consultar[0]->estatus == 'Activo'){
                    //dd($i);
                    break;
                }
            } 
            //dd($consultar);
            DB::connection('mysql')->table('banner200')
            ->where('id', $request->input('id_subir_bajar'))
            ->update(['orden' => $consultar[0]->orden]);

            DB::connection('mysql')->table('banner200')
            ->where('id', $consultar[0]->id)
            ->update(['orden' => $request->input('orden_subir_bajar')]);
            
            
            return redirect()->route('modificar_banner_200')->with('mensaje', 'Se actualizo el orden correctamente!')->with('color', 'success');
        }
       
    }
    public function m419()
    {
        return view('errors.419');
    }

    public function Autorizacion_check_mantenimiento($mensaje="",$color="")
    {
        $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
        INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo DESC');
    $mecanicos = DB::connection('mysql_produc')->select('SELECT * FROM adatospersonal where area="MECANICO"');
    $tipo_informes = DB::connection('mysql')->select('SELECT * FROM c_tipo_informe_bitacora_liberacion ');
    $consulta_completa="SELECT 
    detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion,bitacora_liberacion_unidades.n_economico,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 5 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS Puertas__SERVICIO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 6 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS Puertas__EMERGENCIA,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 7 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO,
    
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 8 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 9 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 10 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 11 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 12 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 13 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 14 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_DIRECCIONAL__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 15 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 16 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_INTERMEDIO__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 17 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 18 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_MOTRIZ__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 19 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 20 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 21 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 22 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 23 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 24 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 25 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ASIENTOS__CONDUCTOR,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 26 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ASIENTOS__CARRO_1,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 27 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ASIENTOS__CARRO_2,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 28 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS CÓDIGO_EN_DISPLAY,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 29 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ARTICULACION__ARTICULACION,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 30 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ARTICULACION__SOPORTE,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 31 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ARTICULACION__GRANADAS,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 32 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS CALIBRACION_DE_NEUMATICOS__GRANADAS,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 33 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_DIRECCIONAL__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 34 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_DIRECCIONAL__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 35 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_INTERMEDIO__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 36 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_INTERMEDIO__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 37 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_MOTRIZ__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 38 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_MOTRIZ__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 39 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SUSPENCION__EJE_1,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 40 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SUSPENCION__EJE_2,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 41 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SUSPENCION__EJE_3,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 42 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS TANQUE__DRENADO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 46 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS TANQUE__CHICOTES,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 43 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SOPORTES__MOTOR,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 44 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SOPORTES__TRANSMISION
    FROM 
    detalle_falla_bitacora_liberacion_unidades
    INNER JOIN 
    c_fallas_subseccion_liberacion_unidades ON c_fallas_subseccion_liberacion_unidades.id_fallas_subseccion_liberacion_unidades = detalle_falla_bitacora_liberacion_unidades.id_c_fallas INNER JOIN 
    bitacora_liberacion_unidades ON detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion = bitacora_liberacion_unidades.id_bitacora_liberacion_unidades
    where bitacora_liberacion_unidades.estatus='Pendiente' 
    GROUP BY 
     bitacora_liberacion_unidades.n_economico,
     detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion;
 ";
 $query = BitacoraLiberacionUnidades::query();
 $consulta = $query->where('estatus', 'Pendiente')->get();
 $consulta_fallas = DB::connection('mysql')->select($consulta_completa);

        return view('Transmasivo.Operaciones.Autorizacion_check_mantenimiento')->with('consulta', $consulta)->with('consulta_fallas', $consulta_fallas)->with('mensaje', $mensaje)->with('color', $color);
    }
    
    

    
}
